<?php

namespace App\Models;

use App\Models\Traits\GameModelHelper;
use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use HasFactory;
    use UuidTrait;
    use SoftDeletes;
    use GameModelHelper;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'games';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['owner_id', 'name', 'introduction', 'description', 'thumb', 'file', 'status'];

    /**
     * Query builder find games has status is on the pool
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnPool($builder)
    {
        return $builder->where('status', ON_POOL_GAME_STATUS);
    }

    /**
     * Make builder filter all game when referral has generated link by referral user
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param string $referralId UserID of Role Referral
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfReferral($builder, $referralId)
    {
        return $builder->whereHas('campaign.referrals', function ($q) use ($referralId) {
             return $q->where('referral_id', $referralId);
        });
    }

    /**
     * Check user is the owner of the game by User ID
     *
     * @param string $userId
     *
     * @return boolean
     */
    public function isOwner($userId)
    {
        return $this->owner_id == $userId;
    }

    /**
     * Check if the referral generated the referral link in the game's campaign.
     * If already created, return the referral link
     *
     * @param string $advertiserId User ID has role Referral
     *
     * @return string|null
     */
    public function referable($advertiserId)
    {
        if (is_null($advertiserId) || is_null($this->loadMissing('campaign.referrals')->campaign->referrals->first())) {
            return null;
        }

        // generate link
        return route(PLAY_GAME_ROUTE, [$this->id, $advertiserId]);
    }

    /**
     * Relationship campaign of game
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function campaign()
    {
        return $this->hasOne(Campaign::class, 'game_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class, 'game_id', 'id');
    }
}
