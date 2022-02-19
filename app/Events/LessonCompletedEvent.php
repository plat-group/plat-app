<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LessonCompletedEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /**
     * @var \App\Models\Lesson
     */
    public $lesson;

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
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($lesson, $campaignId, $referralId, $playerId = null)
    {
        $this->lesson = $lesson;
        $this->campaignId = $campaignId;
        $this->referralId = $referralId;
        $this->playerId = $playerId;
    }
}
