<div class="box-campaign-game mt-5">
    <div class="inner-box bg-mauve-400 rounded-3 p-4">
        <x-form::open action="{{ route(CREATE_CAMPAIGN_ROUTE) }}" class="form-default has_validate">
            <x-form::input type="hidden" name="game_id" id="game_id" :value="$game->id"/>
            <div class="row gx-5">
                <div class="col-md-12">
                    <x-form::label :label="trans('web.campaign_total_budget_label')" class="fs-18 fw-bold"/>
                    <x-form::input id="total_budget" name="total_budget" :value="old('total_budget')" class="required"
                                   data-rule-number="true" :data-rule-min="MIN_AMOUNT_CAMPAIGN"/>
                </div>
                <div class="col-md-12 mt-4">
                    <x-form::label :label="trans('web.campaign_creator_budget_label')" class="fs-18 fw-bold"/>
                    <p class="mb-3">{{ trans('web.campaign_creator_budget_help') }}</p>
                    <x-form::input name="creator_budget" :value="old('budget_creator')" class="required w-50"
                                   data-rule-number="true" :data-rule-min="MIN_AMOUNT_CAMPAIGN"/>
                </div>
                <div class="col-md-12 mt-4">
                    <x-form::label :label="trans('web.campaign_referral_budget_label')" class="fs-18 fw-bold"/>
                    <p class="mb-3">{{ trans('web.campaign_referral_budget_help') }}</p>
                    <x-form::input name="referral_budget" :value="old('referral_budget')" class="required w-50"
                                   data-rule-number="true" :data-rule-min="MIN_AMOUNT_CAMPAIGN"/>
                </div>
                <div class="col-md-12 mt-4">
                    <x-form::label :label="trans('web.campaign_user_budget_label')" class="fs-18 fw-bold"/>
                    <p class="mb-3">{{ trans('web.campaign_user_budget_help') }}</p>
                    <x-form::input name="user_budget" :value="old('budget_user')" class="required w-50"
                                   data-rule-number="true" :data-rule-min="MIN_AMOUNT_CAMPAIGN"/>
                </div>
                <div class="col-md-12 mt-4">
                    <button type="submit" id="btn-push-to-pool" class="btn btn-red-pink px-5 py-2">
                        {{ trans('web.push_to_pool') }}
                    </button>
                    <span class="ms-3">{{ trans('message.campaign_form_helper') }}</span>
                </div>
            </div>
        </x-form::open>
    </div>
</div>
@push('js')
    <script src="{{ mix('static/js/web/pages/plats_deposit.js') }}" type="text/javascript"></script>
@endpush
