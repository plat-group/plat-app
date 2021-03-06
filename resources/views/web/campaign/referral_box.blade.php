<div class="box-referral-game mt-3 mb-3">
    <div class="inner-box bg-primary-2  rounded-3 p-3">
        <div class="row gx-5 mb-4">
            <div class="col-md-12">
                <x-form::label :label="trans('web.campaign_total_budget_label')" class="fs-18 fw-bold"/>
                <x-form::input name="total_budget" value="" readonly="true"/>
            </div>
            <div class="col-md-12 mt-4">
                <x-form::label :label="trans('web.campaign_referral_budget_label')" class="fs-18 fw-bold"/>
                <p class="mb-3">{{ trans('web.campaign_referral_budget_help') }}</p>
                <x-form::input name="referral_budget" value="" readonly="true"/>
            </div>
            <div class="col-md-12 mt-4">
               {{-- @if ($game->referable(Auth::id()))
               $campaign->referral_budget
               $campaign->total_budget
                <div class="row">
                    <div class="col-md-10">
                        <x-form::label :label="trans('web.affiliate_link')" class="fs-18 fw-bold"/>
                        <x-form::input name="referral_link" :value="$game->referable(Auth::id())" readonly="true"/>
                    </div>
                    <div class="col-md-2 align-self-end d-grid">
                        <button type="button" class="btn btn-blue-ribbon text-white">
                            {{ trans('web.copy') }}
                        </button>
                    </div>
                </div>
                @else
                    <a class="btn btn-blue-ribbon text-white px-3 py-2 fw-bold" title="{{ trans('web.generate_link') }}"
                       href="{{ route(GENERATE_LINK_CAMPAIGN_ROUTE, [$game->id, $game->campaign->id]) }}">
                        {{ trans('web.generate_link') }}
                    </a>
                @endif--}}
            </div>
        </div>
    </div>
</div>
