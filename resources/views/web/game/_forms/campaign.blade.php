<div class="box-campaign-game mt-5">
    <div class="inner-box bg-mauve-400 rounded-3 p-4">
        <x-form::open action="{{ route(ORDER_GAME_ROUTE, $game->id) }}" class="form-default has_validate">
            <x-form::input type="hidden" name="game_id" :value="$game->id"/>
            <div class="row gx-5">
                <div class="col-md-12">
                    <x-form::label label="Total token for this campaign" class="fs-18 fw-bold"/>
                    <x-form::input name="agreement_amount" :value="old('agreement_amount')" class="required" data-rule-number="true"/>
                </div>
                <div class="col-md-12 mt-4">
                    <x-form::label label="Token for each play for referral" class="fs-18 fw-bold"/>
                    <p class="mb-3">* Token amount will be paid to referral every time user finish playing game</p>
                    <x-form::input name="royalty_fee" :value="old('royalty_fee')" class="required w-50" data-rule-number="true"/>
                </div>
                <div class="col-md-12 mt-4">
                    <x-form::label label="Token for each play for user" class="fs-18 fw-bold"/>
                    <p class="mb-3">* Token amount will be paid to user every time the game played</p>
                    <x-form::input name="royaltsy_fee" :value="old('royalty_fee')" class="required w-50" data-rule-number="true"/>
                </div>
                <div class="col-md-12 mt-4">
                    <button type="submit" class="btn btn-red-pink px-5 py-2">
                        Push
                    </button>

                    <span class="ms-3">*Campaign will be finished once total token empty</span>
                </div>
            </div>
        </x-form::open>
    </div>
</div>
