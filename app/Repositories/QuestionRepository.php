<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\Concerns\BaseRepository;

class QuestionRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Question::class;
    }
}
