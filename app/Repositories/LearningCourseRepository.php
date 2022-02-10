<?php

namespace App\Repositories;

use App\Models\LearningCourse;
use App\Repositories\Concerns\BaseRepository;

class LearningCourseRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LearningCourse::class;
    }
}
