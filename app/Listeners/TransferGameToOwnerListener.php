<?php

namespace App\Listeners;

use App\Events\OrderConfirmedEvent;
use App\Services\GameService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TransferGameToOwnerListener
{

    /**
     * @var \App\Services\GameService
     */
    protected $gameService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * Handle the event.
     *
     * @param OrderConfirmedEvent $event
     *
     * @return boolean
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function handle(OrderConfirmedEvent $event)
    {
        if (!$event->accepted) {
            return true;
        }

        $order = $event->order->loadMissing('game');

        // Clone data from template to game data and transfer owner
        $this->gameService->cloneTemplate($order->game, $order->client_id);

        // Finish
        return true;
    }
}
