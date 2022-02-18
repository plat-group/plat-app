<?php

namespace Tests\App\Events;

use Tests\TestCase;
use App\Events\CampaignCreatedEvent;
use App\Models\Campaign;

class CampaignCreatedEventTest extends TestCase
{
    /**
     * A basic test example.
     * vendor/bin/phpunit --filter testEventDispatch tests/App/Events/CampaignCreatedEventTest.php
     * @return void
     */
    public function testEventDispatch()
    {
        $cam = new Campaign();
        $cam->game_id = 'adsfadsfadfadfa';
        $cam->content_id = 'adsfadsfadfadfa';
        $cam->total_budget = '100';
        $cam->creator_budget = '1';
        $cam->referral_budget = '2';
        $cam->user_budget = '3';
        CampaignCreatedEvent::dispatch($cam);
    }
}
