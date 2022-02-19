<div class="box-campaign-l2e text-white">
    <div class="inner-box bg-primary-2 rounded-3 p-4">
        <x-form::open action="{{ route(CREATE_CAMPAIGN_ROUTE) }}" class="form-default has_validate" id="campaign">
            <x-form::input type="hidden" name="content_id" id="campaign_content_id" :value="$contentId"/>
            <x-form::input type="hidden" name="content_type" id="campaign_content_id" :value="CAMPAIGN_LEARN"/>
            <div class="row gx-5">
                <div class="col-md-12">
                    <x-form::label :label="trans('web.campaign_total_budget_label')" class="fs-18 fw-bold"/>
                    <x-form::input id="total_budget" name="total_budget" :value="old('total_budget')" class="required"
                                   data-rule-number="true" :data-rule-min="MIN_AMOUNT_CAMPAIGN"/>
                </div>
                <div class="col-md-12 mt-4">
                    <x-form::label label="Token for each learned for user" class="fs-18 fw-bold"/>
                    <p class="mb-3">* Token amount will be paid to user every time the learning</p>
                    <x-form::input name="referral_budget" :value="old('referral_budget')" class="required w-50"
                                   data-rule-number="true" :data-rule-min="MIN_AMOUNT_CAMPAIGN"/>
                </div>
                <div class="col-md-12 mt-4">
                    <x-form::label label="Token for each learned for referral" class="fs-18 fw-bold"/>
                    <p class="mb-3">* Token amount will be paid to referal every time user finish learning</p>
                    <x-form::input name="user_budget" :value="old('budget_user')" class="required w-50"
                                   data-rule-number="true" :data-rule-min="MIN_AMOUNT_CAMPAIGN"/>
                </div>
                <div class="col-md-12 mt-4">
                    <button type="submit" id="btn-push-to-pool" class="btn btn-blue-ribbon text-white px-5 py-2 mb-2">
                        {{ trans('web.push_to_pool') }}
                    </button>
                    <p class="mb-3">{{ trans('message.campaign_form_helper') }}</p>
                </div>
            </div>
        </x-form::open>
    </div>
</div>
@push('js')
    {{--<script src="{{ mix('static/js/web/pages/plats_deposit.js') }}" type="text/javascript"></script>--}}
@endpush
