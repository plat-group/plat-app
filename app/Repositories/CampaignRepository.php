<?php

namespace App\Repositories;

use App\Models\Campaign;
use App\Repositories\Concerns\BaseRepository;

class CampaignRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Campaign::class;
    }

    /**
     * Get campaign of game
     *
     * @param string $id Campaign ID
     * @param string $gameId Game Id
     *
     * @return mixed
     */
    public function ofGame($id, $gameId)
    {
        return $this->model->ofGame($gameId, $id)->firstOrFail();
    }
}
