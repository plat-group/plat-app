<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CreateGameRequest;
use App\Services\GameTemplateService;
use Illuminate\Http\Request;

class MyGame extends Controller
{

    /**
     * @var \App\Services\GameTemplateService
     */
    protected GameTemplateService $gameTemplateService;

    /**
     * @param \App\Services\GameTemplateService $gameTemplateService
     */
    public function __construct(GameTemplateService $gameTemplateService)
    {
        $this->gameTemplateService = $gameTemplateService;
    }

    /**
     * Show list game has created by user
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $assign = [
            'myGames' => $this->gameTemplateService->search(['creator_id' => $request->user()->id])
        ];

        return view('web.game.my_game', $assign);
    }

    /**
     * Show detail game of creator
     *
     * @param $gameId
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($gameId)
    {
        $assign = [
            'game' => $this->gameTemplateService->find($gameId)
        ];

        return view('web.game.detail', $assign);
    }

    /**
     * Show form create a new template game
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('web.game.market.create_template');
    }

    /**
     * Handle store a new template game
     *
     * @param \App\Http\Requests\Web\CreateGameRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreateGameRequest $request)
    {
        $this->gameTemplateService->create($request, $request->user()->id);

        return redirect()->route(MY_GAME_ROUTE);
    }
}
