<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var \App\Models\Order
     */
    public $order;

    /**
     * @var bool|mixed
     */
    public $accepted;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($order, $accepted = true)
    {
        $this->order    = $order;
        $this->accepted = $accepted;
    }
}
