<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;

trait GameModelHelper
{
    /**
     * Set attribute thumb_url with full url
     *
     * @return string
     */
    public function getThumbUrlAttribute()
    {
        return Storage::url($this->thumb);
    }

    /**
     * Define url for show detail game template
     *
     * @return string
     */
    public function getDetailUrlAttribute()
    {
        return route(DETAIL_GAME_ROUTE, $this->id);
    }

    /**
     * Check the status of the game has been published on the market
     *
     * @return boolean
     */
    public function getOnMarketAttribute()
    {
        return $this->status == ON_MARKET_GAME_STATUS;
    }

    /**
     * Check the status of the game has been published on the pool
     *
     * @return boolean
     */
    public function getOnPoolAttribute()
    {
        return $this->status == ON_POOL_GAME_STATUS;
    }

    /**
     * Check if the creator has finished creating the game according to the client's request
     * If the job is done, there is a way to put the game on the pool
     *
     * @return bool
     */
    public function canPushToPool()
    {
        return $this->status == FINISHED_CREATING_GAME_STATUS;
    }
}
