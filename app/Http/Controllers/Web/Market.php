<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\OrderGameRequest;
use App\Services\GameTemplateService;
use Illuminate\Http\Request;

class Market extends Controller
{

    /**
     * @var \App\Services\GameTemplateService
     */
    protected $gameService;

    /**
     * @param \App\Services\GameTemplateService $gameService
     */
    public function __construct(GameTemplateService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * Get list game published on market
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $assign = [
            'games' => $this->gameService->market()
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

    }
}
