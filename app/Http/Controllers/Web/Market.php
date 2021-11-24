<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\OrderGameRequest;
use App\Services\GameTemplateService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class Market extends Controller
{

    /**
     * @var \App\Services\GameTemplateService
     */
    protected $gameService;

    /**
     * @var \App\Services\OrderService
     */
    protected $orderService;

    /**
     * @param \App\Services\GameTemplateService $gameService
     * @param \App\Services\OrderService $orderService
     */
    public function __construct(GameTemplateService $gameService, OrderService $orderService)
    {
        $this->gameService = $gameService;
        $this->orderService = $orderService;
    }

    /**
     * Get list game published on market
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $requestConditions = [];

        $assign = [
            'games' => $this->gameService->market($requestConditions)
        ];

        return view('web.game.market.index', $assign);
    }

    /**
     * @param $gameId
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($gameId)
    {
        $assign = [
            'game' => $this->gameService->find($gameId)
        ];

        return view('web.game.detail', $assign);
    }

    public function order(OrderGameRequest $request)
    {
        $this->orderService->create($request);

        return redirect()->route(MY_ORDER_GAME_ROUTE);
    }
}
