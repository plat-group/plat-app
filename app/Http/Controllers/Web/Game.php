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
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $assign = [
            'game' => $this->gameService->detailWithUser($id, optional(request()->user()))
        ];

        return view('web.game.detail', $assign);
    }

    /**
     * User play game with referral link
     *
     * @param $id
     * @param $referralId
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function play($id, $referralId)
    {

        return view('web.game.play');
    }
}
