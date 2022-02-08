<?php

namespace App\Listeners;

use App\Listeners\Traits\SmartContract;
use App\Events\PlayedGameEvent;
use App\Services\CampaignService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;

class PayCoinListener implements ShouldQueue
{
    use InteractsWithQueue;
    use SmartContract;

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

        // $command = 'near call ' . $smartContractId . ' withdraw \''
        //            . $this->makeParameters($campaign, $event->playerId) . '\''
        //            . ' --accountId ' . $smartContractId;
        $command = sprintf('near call %s %s \'%s\' --accountId %s --gas 50000000000000 --depositYocto 1
        ',
            $smartContractId, 'reward', $this->makeParameters($campaign, $event->playerId), $smartContractId);

        $this->commandlineRun($command);
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
        $gameId = $campaign->game_id;

        $result = [
            'game_id' => $gameId,
            'referral_id' => 'platreferral.testnet',
            'user_id'     => $player
        ];

        return json_encode($result);
    }
}
