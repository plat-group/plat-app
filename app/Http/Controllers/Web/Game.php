<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CreateGameRequest;
use App\Http\Requests\Web\FinishGameRequest;
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
     * Show form create a new template game
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($order)
    {
        return view('web.game.pool.create', compact('order'));
    }

    /**
     * Handle store a new template game
     *
     * @param \App\Http\Requests\Web\CreateGameTemplateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreateGameRequest $request)
    {
        $this->gameService->create($request, $request->user()->id);

        return redirect()->route(MY_GAME_ROUTE);
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
     * @param string $id Game ID
     * @param string $referralId
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function play($id, $referralId)
    {
        // $assign = [
        //     'game' => $this->gameService->find($id),
        //     'referral' => $referralId,
        // ];
        // return view('web.game.play', $assign);

        $game = $this->gameService->find($id);

        return redirect()->to(sprintf('/upload/game/plats-card-game/index.html?gid=%s&cid=%s&rid=%s', $id, $game->campaign->id, $referralId));
    }

    /**
     * Handle after player finish game
     *
     * @param \App\Http\Requests\Web\FinishGameRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finish(FinishGameRequest $request)
    {
        $this->gameService->finish($request);

        return response()->json([
            'success' => true,
        ]);
    }
}
