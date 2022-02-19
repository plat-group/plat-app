<?php

namespace App\Listeners;

use App\Listeners\Traits\SmartContract;
use App\Events\PlayedGameEvent;
use App\Services\CampaignService;
use App\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class PayCoinListener implements ShouldQueue
{
    use InteractsWithQueue;
    use SmartContract;

    /**
     * @var \App\Services\CampaignService
     */
    protected $campaignService;
    protected $userService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CampaignService $campaignService, UserService $userService)
    {
        $this->campaignService = $campaignService;
        $this->userService     = $userService;
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

        $referalId = $event->referralId;
        $playerId = $event->playerId;

        $refererWallet = '';
        if($referalId) {
            $referer = $this->userService->find($referalId);
            $refererWallet = $referer->wallet_address;
        }

        $userWallet = '';
        if($playerId) {
            $user = $this->userService->find($playerId);
            $userWallet = $user->wallet_address;
        }

        $command = sprintf('near call %s %s \'%s\' --accountId %s --gas 50000000000000 --depositYocto 1',
            $smartContractId, 'reward', $this->makeParameters($campaign, $userWallet, $refererWallet), $smartContractId);

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
    private function makeParameters($campaign,  $userWallet, $refererWallet = null)
    {
        $contentId = $campaign->content_id;

        $result = [
            'game_id' => $contentId,
            'user_id'     => $userWallet
        ];

        if($refererWallet) {
            $result['referral_id'] = $refererWallet;
        }

        Log::debug($result);

        return json_encode($result);
    }
}
