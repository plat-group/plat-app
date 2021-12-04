<?php

namespace App\Listeners;

use App\Events\PlayedGameEvent;
use App\Services\CampaignService;
use Illuminate\Console\Application;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;

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
        $smartContractId = $this->getSmartContractId();

        $command = 'near call ' . $smartContractId . ' withdraw \''
                   . $this->makeParameters($campaign) . '\''
                   . ' --accountId ' . $smartContractId;

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
        // $command = Application::formatCommandString($command) . ' ' . ' > /dev/null 2>&1 &';
        $command .= ' > /dev/null 2>&1 &';
        Log::debug("command = $command");
        Process::fromShellCommandline($command, base_path())->run();

        return true;
    }

    /**
     * Create parameters of Near CLI command
     *
     * @param $campaign
     *
     * @return false|string
     */
    private function makeParameters($campaign)
    {
        $result = [
            'client' => 'nghilt.testnet',
            'user_id' => 'platuser.testnet',
            'referral_id' => 'platreferral.testnet',
            'creator_id' => 'platcreator.testnet',
            'team' => 'platteam.testnet',
            'amount_user' => $this->toYokto($campaign->user_budget),
            'amount_referral' => $this->toYokto($campaign->referral_budget),
            'amount_creator' => $this->toYokto($campaign->creator_budget),
            'amount_team' => $this->toYokto(0.01),
        ];

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
        return $number * pow(10, 24) ;  // $number * 1000000000000000000000000 ;
    }

    private function getSmartContractId() {
        return env('SMART_CONTRACT_ID', 'platserver.testnet');
    }
}
