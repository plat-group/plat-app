<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Lesson extends Model
{
    use HasFactory;
    use UuidTrait;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lessons';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'course_id',
        'name',
        'thumbnail',
        'content_url',
        'content_type',
        'description',
    ];


    /**
     * @return string
     */
    public function getThumbUrlAttribute()
    {
        return Storage::url($this->thumb);
    }
}
