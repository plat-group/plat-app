<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\Request;

class MyOrder extends Controller
{

    /**
     * @var \App\Services\OrderService
     */
    protected $orderService;

    /**
     * @param \App\Services\OrderService $orderService
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Show list order
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        if ($request->user()->isClient()) {
            $orders = $this->orderService->clientOrders($request->user()->id);
        } else {
            $orders = $this->orderService->creatorOrders($request->user()->id);
        }

        return view('web.game.my_order', ['orders' => $orders]);
    }
}
