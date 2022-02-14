<?php

namespace App\Services;

use App\Services\Concerns\BaseService;
use App\Repositories\TransactionRepository;

class TransactionService extends BaseService
{

    /**
     * @param \App\Repositories\TransactionRepository $repository
     */
    public function __construct(TransactionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all Transactions of client
     *
     * @param string $userId User Id
     *
     * @return mixed
     */
    public function getTransactions($userId)
    {
        return $this->repository->getTransactions($userId);
    }
}
