<?php

namespace App\Listeners;

use App\Events\PlayedGameEvent;
use App\Services\CampaignService;
use Illuminate\Console\Application;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Symfony\Component\Process\Process;

class PayCoinListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var \App\Services\CampaignService
     */
    protected $campaignService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    /**
     * Handle the event.
     *
     * @param  PlayedGameEvent  $event
     * @return void
     */
    public function handle(PlayedGameEvent $event)
    {
        $campaign = $this->campaignService->find($event->campaignId);

        $command = 'near call platserver.testnet withdraw \''
                   . $this->makeParameters($campaign, $event->playerId) . '\''
                   . '--accountId platserver.testnet';

        $this->commandlineRun($command);
    }

    /**
     * Run a commandline
     *
     * @param $command
     *
     * @return bool
     */
    public function commandlineRun($command)
    {
        $command = Application::formatCommandString($command) . ' ' . ' > /dev/null 2>&1 &';

        Process::fromShellCommandline($command, base_path())->run();

        return true;
    }

    /**
     * Create parameters of Near CLI command
     *
     * @param $campaign
     * @param string $player
     *
     * @return false|string
     */
    private function makeParameters($campaign, $player = null)
    {
        $result = [
            'client' => 'nghilt.testnet',
            'referral_id' => 'platreferral.testnet',
            'amount_referral' => $this->toYokto($campaign->referral_budget),
            'creator_id' => 'platcreator.testnet',
            'amount_creator' => $this->toYokto($campaign->creator_budget),
            'team' => 'platteam.testnet',
            'amount_team' => $this->toYokto(0.001),
        ];

        // the player is not a guest
        if (!is_null($player)) {
            $result[] = [
                'user_id'     => 'platuser.testnet',
                'amount_user' => $this->toYokto($campaign->user_budget),
            ];
        }

        return json_encode($result);
    }

    /**
     * Convert to Yokto for amount withdraw by Near CLI
     *
     * @param float|int $number
     *
     * @return float
     */
    private function toYokto($number)
    {
        return $number * 1000000000000000000000000;
    }
}
