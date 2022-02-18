<?php

namespace App\Repositories;

use App\Models\GameTemplate;
use App\Repositories\Concerns\BaseRepository;

class GameTemplateRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GameTemplate::class;
    }
}
