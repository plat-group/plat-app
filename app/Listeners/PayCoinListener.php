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
                   . $this->makeParameters($campaign, $event->playerId) . '\''
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
        // $command .= ' > /dev/null 2>&1 &';

        // Write log for debug command line
        Log::debug("command = $command");

        $process = Process::fromShellCommandline($command, base_path())->run();

        Log::debug($process);

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
            'game_id' => 1,
            'client' => 'platclient.testnet',
            'referral_id' => 'platreferral.testnet',
            'amount_referral' => $this->toYokto($campaign->referral_budget),
            'creator_id' => 'platcreator.testnet',
            'amount_creator' => $this->toYokto($campaign->creator_budget),
            'team' => 'platteam.testnet',
            'amount_team' => $this->toYokto(0.001),
            'user_id'     => 'platuser.testnet',
            'amount_user' => $this->toYokto($campaign->user_budget),
        ];

        return json_encode($result);
    }
    // private function makeParameters($campaign, $player = null)
    // {
    //     $result = [
    //         'game_id' => 1,
    //         'client' => 'platclient.testnet',
    //         'referral_id' => 'platreferral.testnet',
    //         'amount_referral' => $this->toYokto($campaign->referral_budget),
    //         'creator_id' => 'platcreator.testnet',
    //         'amount_creator' => $this->toYokto($campaign->creator_budget),
    //         'team' => 'platteam.testnet',
    //         'amount_team' => $this->toYokto(0.001),
    //         'user_id'     => 'platuser.testnet',
    //         'amount_user' => $this->toYokto($campaign->user_budget),
    //     ];

    //     // // Player is not a guest
    //     // if (!is_null($player)) {
    //     //     $result[] = [
    //     //         'user_id'     => 'platuser.testnet',
    //     //         'amount_user' => '' . $this->toYokto($campaign->user_budget),
    //     //     ];
    //     // }

    //     return json_encode($result);
    // }

    /**
     * Convert to Yokto for amount withdraw by Near CLI
     *
     * @param float|int $number
     *
     * @return float
     */
    private function toYokto($number)
    {
        $val = $number * pow(10, 24) ;  // $number * 1000000000000000000000000;
        return sprintf("%.0f", $val);
    }

    /**
     * Get Near Smart Contract
     *
     * @return string
     */
    private function getSmartContractId()
    {
        return env('SMART_CONTRACT_ID', 'platserver.testnet');
    }
}
