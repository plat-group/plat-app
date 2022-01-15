<div>Order Content</div>
@include('web.game._forms.order', ['game' => $game])

<div class="box-order-game mt-5">
    <div>Release from Creator</div>
    <div class="inner-box bg-mauve-400 rounded-3 px-4 pt-3 pb-5">
        icon <button type="button" class="btn btn-red-pink btn-lg">
                    {{ trans('web.btn_download_resource') }}
                </button>
        icon <button type="button" class="btn btn-red-pink btn-lg">
            {{ trans('web.btn_play_game') }}
        </button>
        <button type="button" class="btn btn-red-pink btn-lg">
            {{ trans('web.btn_push_to_pool') }}
        </button>
    </div>
</div>
@push('js')
    <script src="{{ mix('static/js/web/pages/near_deposit.js') }}" type="text/javascript"></script>
@endpush
