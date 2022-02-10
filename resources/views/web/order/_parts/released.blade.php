@if($order->resource_file && $order->game_file)
<div class="box-order-game mt-5">
    <div class="inner-box bg-primary-2 rounded-3 px-4 pt-3 pb-5">
        <div>{{ trans('web.order_detail.release_title_' . (isClient() ? 'client' : 'creator')) }}</div>
            @if($order->resource_file)
                icon
                <a href="{{route(ORDER_DOWNLOAD_RESOURCE_ROUTE, $order->id)}}">
                    <button type="button" class="btn btn-blue-ribbon text-white btn-lg">
                        {{ trans('web.btn_download_resource') }}
                    </button>
                </a>
                <br>
            @endif
            @if($order->game_file)
                icon
                <a href="{{$order->game_file}}">
                <button type="button" class="btn btn-blue-ribbon text-white btn-lg">
                    {{ trans('web.btn_play_game') }}
                </button>
                </a>
            @endif
        @if(isClient())
            <a href="{{ route(CREATE_GAME_ROUTE, $order->id) }}" title="{{ trans('web.btn_push_to_pool') }}" class="btn btn-blue-ribbon text-white fw-bold ms-auto">
                {{ trans('web.btn_push_to_pool') }}
            </a>
        @endif
    </div>
</div>
@endif
