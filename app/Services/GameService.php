<?php

namespace App\Services;

use App\Events\PlayedGameEvent;
use App\Repositories\GameRepository;
use App\Services\Concerns\BaseService;
use Illuminate\Http\Request;

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
     * Make pagination with conditions
     *
     * @param array $conditions
     *
     * @return mixed
     */
    public function search($conditions = [])
    {
        $this->makeBuilder($conditions);

        if ($this->filter->has('referral_id')) {
            //Filter game of referral
            $this->builder->ofReferral($this->filter->get('referral_id'));
            // Clean filter
            $this->cleanFilterBuilder('referral_id');
        }

        return $this->endFilter();
    }

    /**
     * Find detail of game by ID with role of user logged in
     *
     * @param string $id
     * @param null|\App\Models\User $user
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed|void
     */
    public function detailWithUser($id, $user = null)
    {
        // When guest
        if (is_null($user) || $user->isCreator()) {
            return $this->find($id);
        }

        if ($user->isReferraler()) {
            return $this->repository->detailWithReferral($id, $user->id);
        }

        return $this->find($id)->loadMissing('campaign');
    }

    /**
     * Get all game published on pool
     *
     * @param array $conditions
     *
     * @return mixed
     */
    public function onPool($conditions = [])
    {
        $this->makeBuilder($conditions);

        $this->builder->onPool();

        return $this->endFilter();
    }

    /**
     * Push game on the pool
     *
     * @param string $gameId
     */
    public function pushToPool($gameId)
    {
        // Get record of game
        $game = $this->repository->find($gameId);

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

    /**
     * Handle after player finish game
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     */
    public function finish(Request $request)
    {
        $game = $this->find($request->input('game_id'));

        // Fire event
        PlayedGameEvent::dispatch(
            $game,
            $request->input('campaign_id'),
            $request->input('referral_id'),
            optional($request->user())->id
        );

        return $game;
    }
}
