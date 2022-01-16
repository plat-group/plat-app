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
        } elseif ($request->user()->isCreator()) {
            $orders = $this->orderService->creatorOrders($request->user()->id);
        } else {
            return $this->incomeHistories($request);
        }

        return view('web.order.list', ['orders' => $orders]);
    }

    /**
     * Creator|Client view detail of order
     *
     * @param string $orderId
     * @param int|string $action
     */
    public function show($orderId) {
        $order = $this->orderService->find($orderId)->loadMissing('gameTemplate');
        $game = $order->gameTemplate;

        return view('web.order.detail', compact('order', 'game'));
    }

    /**
     * Creator|Client view detail of order
     *
     * @param string $orderId
     * @param int|string $action
     */
    public function storeGame($request) {
        // TODO need implement
    }

    /**
     * Creator confirm request order game of client
     *
     * @param string $orderId
     * @param int|string $action
     */
    public function confirm($orderId, $action = DENIED_ORDER_STATUS)
    {
        $this->orderService->confirm(request()->user(), $orderId, ($action == ACCEPTED_ORDER_STATUS));

        return redirect()->back();
    }

    /**
     * Income histories of user (Role: Referral/User)
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function incomeHistories(Request $request)
    {
        return view('web.income.history');
    }
}
