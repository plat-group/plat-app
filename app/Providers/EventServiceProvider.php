<?php

namespace App\Providers;

use App\Events\CampaignCreatedEvent;
use App\Events\LessonCompletedEvent;
use App\Events\OrderConfirmedEvent;
use App\Events\PlayedGameEvent;
use App\Listeners\PayCoinListener;
use App\Listeners\PushToPoolListener;
use App\Listeners\SaveTransactionListener;
use App\Listeners\TransferGameToOwnerListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        OrderConfirmedEvent::class => [
            TransferGameToOwnerListener::class
        ],
        CampaignCreatedEvent::class => [
            PushToPoolListener::class
        ],
        PlayedGameEvent::class => [
            SaveTransactionListener::class,
            PayCoinListener::class,
        ],
        LessonCompletedEvent::class => [
            PayCoinListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
