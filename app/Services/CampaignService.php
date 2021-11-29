<?php

namespace App\Services;

use App\Events\CampaignCreatedEvent;
use App\Repositories\CampaignRepository;
use App\Repositories\GameRepository;
use App\Services\Concerns\BaseService;
use Illuminate\Http\Request;

class CampaignService extends BaseService
{

    /**
     * @var \App\Repositories\GameRepository
     */
    protected $gameRepository;

    /**
     * @param \App\Repositories\CampaignRepository $repository
     * @param \App\Repositories\GameRepository $gameRepository
     */
    public function __construct(CampaignRepository $repository, GameRepository $gameRepository)
    {
        $this->repository = $repository;
        $this->gameRepository = $gameRepository;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        // Get and check exits game by request id
        $game = $this->gameRepository->find($request->input('game_id'));

        // check permission
        $request->user()->can('createCampaign', $game);

        $campaign = $this->repository->create($request->toArray());

        // Fire event
        CampaignCreatedEvent::dispatch($campaign);

        $this->withSuccess(trans('message.campaign_created'));

        return $campaign;
    }

    /**
     * Save generated link for referral
     *
     * @param $referralId
     * @param $campaignId
     * @param $gameId
     *
     * @return mixed
     */
    public function generateLink($referralId, $campaignId, $gameId)
    {
        // Find or fail exist record
        $campaign = $this->repository->ofGame($gameId, $campaignId);

        // Attach record
        return $campaign->referrals()->attach($referralId);
    }
}
