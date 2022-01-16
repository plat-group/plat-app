<div class="box-order-game mt-5">
    <div class="inner-box bg-mauve-400 rounded-3 px-4 pt-3 pb-5">
        <div>{{ trans('web.order_detail.release_title_' . (isClient() ? 'client' : 'creator')) }}</div>
        icon <button type="button" class="btn btn-red-pink btn-lg">
                    {{ trans('web.btn_download_resource') }}
                </button><br>
        icon <button type="button" class="btn btn-red-pink btn-lg">
            {{ trans('web.btn_play_game') }}
        </button>
        @if(isClient())
            <button type="button" class="btn btn-red-pink btn-lg">
                {{ trans('web.btn_push_to_pool') }}
            </button>
        @endif
    </div>
</div>
