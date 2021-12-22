<?php

namespace App\Services;

use App\Events\CampaignCreatedEvent;
use App\Repositories\CampaignRepository;
use App\Repositories\GameRepository;
use App\Repositories\TransactionRepository;
use App\Services\Concerns\BaseService;
use Illuminate\Http\Request;

class CampaignService extends BaseService
{

    /**
     * @var \App\Repositories\GameRepository
     */
    protected $gameRepository;

    /**
     * @var
     */
    protected $transactionRepository;

    /**
     * @param \App\Repositories\CampaignRepository $repository
     * @param \App\Repositories\GameRepository $gameRepository
     * @param \App\Repositories\TransactionRepository $transactionRepository
     */
    public function __construct(
        CampaignRepository $repository,
        GameRepository $gameRepository,
        TransactionRepository $transactionRepository
    ) {
        $this->repository = $repository;
        $this->gameRepository = $gameRepository;
        $this->transactionRepository = $transactionRepository;
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

    public function payRewards($campaignId, $player, $advertiser)
    {
        $campaign = $this->find($campaignId)->loadMissing(['game.order.gameTemplate']);
        $game = $campaign->game;

        //Pay for Player
        if (!is_null($player)) {
            //Player is guest
            $this->transactionRepository->saveHistory(
                $campaign->user_budget,
                $player,
                $campaign->id,
                $advertiser
            );
        }

        //Pay for Advertiser
        $this->transactionRepository->saveHistory(
            $campaign->referral_budget,
            $advertiser,
            $campaign->id,
            $advertiser
        );

        // Pay for creator
        $creatorId = $game->order->gameTemplate->creator_id;
        $this->transactionRepository->saveHistory(
            $campaign->creator_budget,
            $creatorId,
            $campaign->id,
            $advertiser
        );

        return true;
    }
}
