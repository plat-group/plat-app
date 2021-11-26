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
}
