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
     * Set attribute thumb_url with full url
     *
     * @return string
     */
    public function getThumbUrlAttribute()
    {
        return Storage::url($this->thumb);
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
