<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PlayedGameEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var \App\Models\Game
     */
    public $game;

    /**
     * Campaign ID
     *
     * @var string
     */
    public $campaignId;

    /**
     * Referral ID
     *
     * @var string
     */
    public $referralId;

    /**
     * Player ID
     * @var string|null
     */
    public $playerId;

    /**
     * Finish game at
     *
     * @var \Carbon\Carbon
     */
    public $finishAt;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($game, $campaignId, $referralId, $playerId = null)
    {
        $this->game       = $game;
        $this->campaignId = $campaignId;
        $this->referralId = $referralId;
        $this->playerId = $playerId;
        $this->finishAt = Carbon::now();
    }
}
