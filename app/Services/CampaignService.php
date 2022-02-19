<?php

namespace App\Services;

use App\Events\CampaignCreatedEvent;
use App\Repositories\CampaignRepository;
use App\Repositories\CourseRepository;
use App\Repositories\GameRepository;
use App\Repositories\TransactionRepository;
use App\Services\Concerns\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CampaignService extends BaseService
{

    /**
     * @var \App\Repositories\GameRepository
     */
    protected $gameRepository;

    /**
     * @var \App\Repositories\CourseRepository
     */
    protected $courseRepository;

    /**
     * @var TransactionRepository
     */
    protected $transactionRepository;

    /**
     * @param \App\Repositories\CampaignRepository $repository
     * @param \App\Repositories\GameRepository $gameRepository
     * @param \App\Repositories\TransactionRepository $transactionRepository
     * @param \App\Repositories\CourseRepository $courseRepository
     */
    public function __construct(
        CampaignRepository $repository,
        GameRepository $gameRepository,
        TransactionRepository $transactionRepository,
        CourseRepository $courseRepository
    ) {
        $this->repository = $repository;
        $this->gameRepository = $gameRepository;
        $this->transactionRepository = $transactionRepository;
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(Request $request)
    {
        // Get and check exits record by request id
        $this->contentByType($request->input('content_id'), $request->input('content_type'));
        //TODO: verify permission user can create campaign

        $campaign = $this->repository->create($request->toArray());

        // Fire event
        CampaignCreatedEvent::dispatch($campaign);

        $this->withSuccess(trans('message.campaign_created'));

        return $campaign;
    }

    /**
     * Save generated link for referrer
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

    /**
     * Get the record to which the campaign belongs
     *
     * @param string $relationId
     * @param int $type
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection|mixed
     */
    public function contentByType($relationId, $type = CAMPAIGN_GAME)
    {
        if ($type == CAMPAIGN_GAME) {
            return $this->gameRepository->find($relationId);
        }

        return $this->courseRepository->find($relationId);
    }
}
