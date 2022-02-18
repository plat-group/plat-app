<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory;
    use UuidTrait;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaigns';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'game_id',
        'content_id',
        'total_budget',
        'creator_budget',
        'referral_budget',
        'user_budget',
        'start_at',
        'end_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'total_budget' => 'decimal:7',
        'creator_budget' => 'decimal:7',
        'referral_budget' => 'decimal:7',
        'user_budget' => 'decimal:7',
    ];

    /**
     * Search all campaigns of game
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $gameId
     * @param string|null $campaignId
     *
     * @return mixed
     */
    public function scopeOfGame($query, $gameId, $campaignId = null)
    {
        if (!is_null($campaignId)) {
            return $query->where('id', $campaignId);
        }

        return $query->where('game_id', $gameId);
    }

    /**
     * Build eager loading of referrals relationship and get one record when existed.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $referralId
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithReferral($query, $referralId)
    {
        return $query->with([
            'referrals' => function ($q) use ($referralId) {
                return $q->wherePivot('referral_id', $referralId)->limit(1);
            }
        ]);
    }

    /**
     * Relationship: Referrals generated link
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function referrals()
    {
        return $this->belongsToMany(User::class, 'campaign_referrals', 'campaign_id', 'referral_id')->withTimestamps();
    }

    /**
     * Relationship with game
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function game()
    {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }
}