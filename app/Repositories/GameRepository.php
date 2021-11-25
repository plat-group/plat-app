<?php

namespace App\Repositories;

use App\Models\Game;
use App\Repositories\Concerns\BaseRepository;

class GameRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Game::class;
    }
}
