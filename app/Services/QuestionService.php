<?php

namespace App\Services;

use App\Repositories\QuestionRepository;
use App\Services\Concerns\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionService extends BaseService
{

    /**
     * @param \App\Repositories\QuestionRepository $repository
     */
    public function __construct(QuestionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get list game published on market
     *
     * @param array $conditions
     *
     * @return mixed
     */
    public function market($conditions = [])
    {
        $this->makeBuilder($conditions);

        $this->builder->onMarket();

        //$this->cleanFilterBuilder([]);

        return $this->endFilter();
    }

}
