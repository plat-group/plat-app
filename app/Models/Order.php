<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use UuidTrait;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'client_id',
        'game_template_id',
        'game_id',
        'content',
        'agreement_amount',
        'royalty_fee',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'agreement_amount' => 'decimal:3',
        'royalty_fee' => 'decimal:3',
    ];

    /**
     * Make query builder for order of creator by user ID
     *
     * @param $model
     * @param string $userId
     *
     * @return mixed
     */
    public function scopeOfCreator($model, $userId)
    {
        return $model->whereHas('gameTemplate', function (Builder $builder) use ($userId) {
            $builder->creator($userId);
        });
    }

    /**
     * Response string definition of order status
     *
     * @return string|null
     */
    public function getStatusTextAttribute()
    {
        return trans('web.list_order_status.' . $this->status);
    }

    /**
     * The status of the order to be confirming
     *
     * @return bool
     */
    public function waitingConfirm()
    {
        return $this->status == ORDERING_ORDER_STATUS;
    }

    /**
     * Determine whether the order is accepted
     *
     * @return boolean
     */
    public function isAccepted()
    {
        return $this->status == ACCEPTED_ORDER_STATUS;
    }

    /**
     * Game Template detail of order by Eloquent relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gameTemplate()
    {
        return $this->belongsTo(GameTemplate::class, 'game_template_id', 'id');
    }

    /**
     * Game detail of order by Eloquent relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function game()
    {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }

    /**
     * Relationship with User for user role is client
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }
}
