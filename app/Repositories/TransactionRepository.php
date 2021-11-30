<?php

namespace App\Repositories;

use App\Repositories\Concerns\BaseRepository;
use App\Models\Transaction;

class TransactionRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Transaction::class;
    }

    /**
     * Get all transactions of user/referral/creator
     *
     * @param string $userId User Id
     *
     * @return mixed
     */
    public function getTransactions($userId)
    {
        return $this->model->where('user_id', $userId)->latest()->get();
    }
}
