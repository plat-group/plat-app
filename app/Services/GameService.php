<?php

namespace App\Services;

use App\Events\PlayedGameEvent;
use App\Repositories\GameRepository;
use App\Repositories\OrderRepository;
use App\Services\Concerns\BaseService;
use App\Services\Traits\Poolable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameService extends BaseService
{
    use Poolable;

    protected $orderRepository;

    /**
     * @param \App\Repositories\GameRepository $repository
     */
    public function __construct(GameRepository $repository, OrderRepository $orderRepository)
    {
        $this->repository = $repository;
        $this->orderRepository = $orderRepository;
    }

    /**
     * Create a game for client
     *
     * @param \Illuminate\Http\Request $request
     * @param string $creatorId
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create($request, $orderId)
    {
        $data = $request->only(['name', 'introduction']);
        $data['owner_id'] = $clientId = $request->user()->id;
        // TODO: Need process before publish on the market
        $data['status'] = FINISHED_CREATING_GAME_STATUS;

        if ($request->hasFile('thumb')) {
            $data['thumb'] = $this->uploadThumb($request->file('thumb'), $clientId);
        }

        $order = $this->orderRepository->find($orderId);
        $data['file'] = $order->game_file; // Game file do creator upload len

        $record = $this->repository->create($data);

        // TODO Call smartcontract to create game data on blockchain

        $this->withSuccess(trans('message.game_created'));

        return $record;
    }

    /**
     * Upload thumb image of game
     *
     * @param \Illuminate\Http\UploadedFile $file
     */
    protected function uploadThumb($file, $createId = null)
    {
        return Storage::putFile('game_template/' . $createId, $file);
    }

    /**
     * Upload game template
     *
     * @param \Illuminate\Http\UploadedFile $file
     */
    protected function uploadGame($file, $createId = null)
    {
        return Storage::putFile('game_template/' . $createId, $file);
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
