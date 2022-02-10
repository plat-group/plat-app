<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CreateGameRequest;
use App\Http\Requests\Web\FinishGameRequest;
use App\Services\GameService;
use App\Services\UserService;

class Game extends Controller
{

    /**
     * @var \App\Services\GameService
     */
    protected $gameService;

    protected $userService;

    /**
     * @param \App\Services\GameService $gameService
     */
    public function __construct(GameService $gameService, UserService $userService)
    {
        $this->gameService = $gameService;
        $this->userService = $userService;
    }

    /**
     * Show form create a game from order
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create($orderId)
    {
        return view('web.game.pool.create', compact('orderId'));
    }

    /**
     * Handle store a new template game
     *
     * @param \App\Http\Requests\Web\CreateGameTemplateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store($orderId, CreateGameRequest $request)
    {
        $this->gameService->create($request, $orderId);

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
        $referral = $this->userService->find($referralId);

        return redirect()->to(sprintf('/upload/%s/index.html?gid=%s&cid=%s&rid=%s', $game->file, $id, $game->campaign->id, $referral->wallet_address));
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
