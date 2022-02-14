<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CreateCampaignRequest;
use App\Services\CampaignService;

class Campaign extends Controller
{

    /**
     * @var \App\Services\CampaignService
     */
    protected $campaignService;

    /**
     * @param \App\Services\CampaignService $campaignService
     */
    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    /**
     * Make a campaign by client for game
     *
     * @param \App\Http\Requests\Web\CreateCampaignRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreateCampaignRequest $request)
    {
        $this->campaignService->store($request);

        return redirect()->back();
    }

    public function generateLink($campaignId, $gameId)
    {
        if (!request()->user()->isReferraler()) {
            abort(404);
        }

        $this->campaignService->generateLink(request()->user()->id, $campaignId, $gameId);

        return redirect()->back();
    }
}
