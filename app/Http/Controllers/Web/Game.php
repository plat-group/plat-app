<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\GameService;

class Game extends Controller
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
     * Show detail game
     *
     * @param string $id
     */
    public function show($id)
    {
        return view('web.game.detail', ['game' => $this->gameService->find($id)]);
    }
}
