<div class="box-order-game mt-5">
    <div class="inner-box bg-mauve-400 rounded-3 px-4 pt-3 pb-5">
        <div>{{ trans('web.order_detail.order_content_' . (isClient() ? 'client' : 'creator')) }}</div>
        <x-form::open action="{{ route(ORDER_GAME_ROUTE, $game->id) }}" class="form-default has_validate">
            <x-form::input type="hidden" name="game_template_id" :value="$game->id"/>
        <div class="row gx-5 mb-4">
            <div class="col-md-5">
                <x-form::label :label="trans('web.order_form.agreement_amount_label')" class="fs-18 fw-bold"/>
                <p class="mb-3">{{ trans('web.order_form.agreement_amount_help') }}</p>
                <br>
                @if(isClient())
                    <x-form::input name="agreement_amount" :value="old('agreement_amount')" class="required" data-rule-number="true" data-behavior="deposit"/>
                    @else
                    <x-form::input name="agreement_amount" value="{{ $order->agreement_amount }}" class="required" data-rule-number="true" data-behavior="deposit" readonly="true"/>
                @endif
            </div>

            <div class="col-md-5">
                <x-form::label :label="trans('web.order_form.royalty_fee_label')" class="fs-18 fw-bold"/>
                <p class="mb-3">{{ trans('web.order_form.royalty_fee_help') }}</p>
                @if(isClient())
                    <x-form::input name="royalty_fee" :value="old('royalty_fee')" class="required" data-rule-number="true"/>
                @else
                    <x-form::input name="royalty_fee" value="{{ $order->royalty_fee }}" class="required" data-rule-number="true" readonly="true"/>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 mb-3 mb-md-0">
                <x-form::label label="Other request" class="fs-18 fw-bold"/>
                @if(isClient())
                    <x-form::textarea name="content" rows="5" :value="old('content')"/>
                @else
                    <x-form::textarea name="content" rows="5" value="{{ $order->content }}" readonly="true"/>
                @endif
            </div>
            @if(isClient())
            <div class="col-md-2 d-md-flex align-items-end align-items-end">
                <button type="submit" id="btn-order" class="btn btn-red-pink px-5 py-2">
                    {{ trans('web.order_form.btn_submit') }}
                </button>
            </div>
            @endif
        </div>
        </x-form::open>
    </div>
</div>
@push('js')
    <script src="{{ mix('static/js/web/pages/near_deposit.js') }}" type="text/javascript"></script>
@endpush
