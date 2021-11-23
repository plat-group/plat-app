<div class="box-order-game mt-5" xmlns:x-form="http://www.w3.org/1999/html">
    <div class="inner-box bg-mauve-400 rounded-3 px-4 pt-3 pb-5">
        <x-form::open action="{{ route(ORDER_GAME_ROUTE, $game->id) }}" class="form-default has_validate">
        <div class="row gx-5 mb-4">
            <div class="col-md-5">
                <x-form::label :label="trans('web.order_form.agreement_amount')" class="fs-18 fw-bold"/>
                <p class="mb-3">{{ trans('web.order_form.agreement_amount_help') }}</p>
                <x-form::input name="agreement_amount" class="required"/>
            </div>
            <div class="col-md-5">
                <x-form::label label="Token for each play" class="fs-18 fw-bold"/>
                <p class="mb-3">* Token amount will be paid to creator every time user finish playing game</p>
                <x-form::input name="play_amount" class="required"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 mb-3 mb-md-0">
                <x-form::label label="Other request" class="fs-18 fw-bold"/>
                <x-form::textarea name="other" rows="5"/>
            </div>
            <div class="col-md-2 d-md-flex align-items-end align-items-end">
                <button type="submit" class="btn btn-red-pink px-5 py-2">
                    {{ trans('web.order_form.btn_submit') }}
                </button>
            </div>
        </div>
        </x-form::open>
    </div>
</div>
