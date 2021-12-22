<?php

namespace App\Listeners;

use App\Services\GameService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PushGameToPoolListener
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
     * @param object $event
     *
     * @return boolean
     */
    public function handle($event)
    {
        // TODO: Need interface
        $gameId = $event->campaign->game_id;
        if (!$gameId) {
            return true;
        }

        // Push game to pool
        $this->gameService->pushToPool($gameId);

        // Finish
        return true;
    }
}
