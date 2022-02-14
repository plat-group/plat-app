<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Concerns\BaseRepository;

class OrderRepository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * Get all orders of client
     *
     * @param string $userId User Id
     *
     * @return mixed
     */
    public function clientOrders($userId)
    {
        return $this->model->where('client_id', $userId)->latest()->get();
    }

    public function creatorOrders($userId)
    {
        return $this->model->ofCreator($userId)->latest()->get();
    }

    /**
     * Get order detail of creator by order id
     *
     * @param string $userId
     * @param string $orderId
     *
     * @return mixed
     */
    public function ofCreator($userId, $orderId)
    {
        return $this->model->ofCreator($userId)->firstWhere('id', $orderId);
    }
}
