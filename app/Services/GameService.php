<?php

namespace App\Services;

use App\Repositories\GameRepository;
use App\Services\Concerns\BaseService;

class GameService extends BaseService
{

    /**
     * @param \App\Repositories\GameRepository $repository
     */
    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Push game on the pool
     *
     * @param string $gameId
     * @param \App\Models\User $owner
     */
    public function pushToPool($gameId, $owner)
    {
        // Get record of game
        $game = $this->repository->find($gameId);

        //authorization user can push game on the pool
        $owner->can('pushToGame', $game);

        $game->status = ON_POOL_GAME_STATUS;
        $game->save();

        return $game;
    }

    /**
     * Clone data from template to game data and transfer owner
     *
     * @param \App\Models\GameTemplate $template
     * @param string $ownerId \App\Models\User Id
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function cloneTemplate($template, $ownerId)
    {
        $data = [
            'owner_id'     => $ownerId,
            'name'         => $template->name,
            'introduction' => $template->introduction,
            'description'  => $template->description,
            'thumb'        => $template->thumb,
            'status'       => FINISHED_CREATING_GAME_STATUS,
        ];

        return $this->repository->create($data);
    }
}
