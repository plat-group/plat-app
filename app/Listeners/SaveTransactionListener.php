<?php

namespace App\Listeners;

use App\Events\PlayedGameEvent;
use App\Services\CampaignService;
use App\Services\TransactionService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveTransactionListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @var \App\Services\TransactionService
     */
    protected $transactionService;

    /**
     * @var \App\Services\CampaignService
     */
    protected $campaignService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(TransactionService $transactionService, CampaignService $campaignService)
    {
        $this->transactionService = $transactionService;
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
        $this->campaignService->payRewards($event->campaignId, $event->playerId, $event->referralId);
    }
}
