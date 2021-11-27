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

    /**
     * Get detail of game with role of user is Referral
     *
     * @param string $id Game Id
     * @param string $advertiserId User ID
     *
     * @return mixed
     */
    public function detailOfReferral($id, $advertiserId)
    {
        return $this->model->where('id', $id)->with(['campaign' => function($q) use ($advertiserId) {
            return $q->ofReferral($advertiserId);
        }])->first();
    }
}
