<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmedEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

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
    public function __construct($order, $accepted = null)
    {
        $this->order    = $order;
        $this->accepted = is_null($accepted) ? false : $accepted;
    }
}
