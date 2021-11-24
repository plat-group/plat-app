<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class GameTemplate extends Model
{
    use UuidTrait;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'game_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['creator_id', 'name', 'introduction', 'description', 'thumb', 'file', 'status'];

    /**
     * Make query builder for all game by creator
     *
     * @param GameTemplate $model
     * @param string $userId
     *
     * @return mixed
     */
    public function scopeCreator($model, $userId)
    {
        return $model->where('creator_id', $userId);
    }

    /**
     * Query builder find games has status is on the market
     *
     * @param GameTemplate $model
     *
     * @return mixed
     */
    public function scopeOnMarket($model)
    {
        return $model->where('status', ON_MARKET_GAME_STATUS);
    }

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
        //if ($this->on_market) {
            return route(MARKET_GAME_DETAIL_ROUTE, $this->id);
        //}

        //return route(DETAIL_GAME_TEMPLATE_ROUTE, $this->id);
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
     * Check user is the author of the game by User ID
     *
     * @param string $userId
     *
     * @return boolean
     */
    public function isAuthor($userId)
    {
        return $this->creator_id == $userId;
    }

    /**
     * Creator information by relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
}
