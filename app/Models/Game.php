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
