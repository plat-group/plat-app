<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonAnswer extends Model
{
    use HasFactory;
    use UuidTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'lesson_answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'question_id',
        'answer',
        'correct',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['correct'];
}
