<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\GameService;

class Pool extends Controller
{

    /**
     * @var \App\Services\GameService
     */
    protected $gameService;

    /**
     * @param \App\Services\GameService $gameService
     */
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * Show list games for client
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('web.game.pool.index', ['games' => $this->gameService->onPool()]);
    }
}
