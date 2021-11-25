<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Game extends Model
{
    use HasFactory;
    use UuidTrait;
    use SoftDeletes;

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
}
