<?php

namespace App\Services;

use App\Repositories\GameTemplateRepository;
use App\Services\Concerns\BaseService;

class GameTemplateService extends BaseService
{

    /**
     * @param \App\Repositories\GameTemplateRepository $repository
     */
    public function __construct(GameTemplateRepository $repository)
    {
        $this->repository = $repository;
    }
}
