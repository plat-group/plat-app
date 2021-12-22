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

        $order = $event->order->loadMissing('gameTemplate');

        // Clone data from template to game data and transfer owner
        $game = $this->gameService->cloneTemplate($order->gameTemplate, $order->client_id);

        //Update game id to order
        $order->game_id = $game->id;
        $order->save();

        // Finish
        return true;
    }
}
