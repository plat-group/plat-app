@extends('web.layout')
@section('title_page') {{ trans('web.my_order') }} @stop
@section('content')
    <x-alert/>
    <div class="table-responsive">
        <table class="table table-flat table-borderless table-striped table-mauve-400">
            <thead>
                <tr class="text-uppercase">
                    <th class="py-3" scope="col">{{ trans('web.my_order_id') }}</th>
                    <th class="py-3" scope="col">
                        {{ Auth::user()->isCreator() ? trans('web.client') : trans('web.creator') }}
                    </th>
                    <th class="py-3" scope="col">{{ trans('web.order_game') }}</th>
                    <th class="py-3" scope="col">{{ trans('web.agreement_amount') }}</th>
                    <th class="py-3" scope="col">{{ trans('web.royalty_fee') }}</th>
                    <th class="py-3" scope="col">{{ trans('web.status') }}</th>
                    <th class="py-3" scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
            <tr>
                <th class="text-center" scope="row">
                    {{ $loop->iteration }}
                </th>
                <td class="text-center">
                    {{ Auth::user()->isCreator() ? $order->client->name : $order->gameTemplate->creator->name }}
                </td>
                <td class="">{{ $order->gameTemplate->name }}</td>
                <td class="text-end">
                    {{ $order->agreement_amount }}
                </td>
                <td class="text-end">
                    {{ $order->royalty_fee }}
                </td>
                <td class="">
                    <div class="hstack gap-3">
                        <span>
                            {{ $order->status_text }}
                        </span>
                        @if (Auth::user()->isCreator() && $order->waitingConfirm())
                            <a href="{{ route(CONFIRM_ORDER_GAME_ROUTE, [$order->id, ACCEPTED_ORDER_STATUS]) }}" title="{{ trans('web.accept') }}"
                               class="btn btn-red-pink fw-bold ms-auto px-3">
                                {{ trans('web.accept') }}
                            </a>
                            <a href="{{ route(CONFIRM_ORDER_GAME_ROUTE, [$order->id, DENIED_ORDER_STATUS]) }}" title="{{ trans('web.deny') }}" class="btn btn-mauve-400 fw-bold
                            px-3">
                                {{ trans('web.deny') }}
                            </a>
                        @endif
                    </div>
                </td>
                <td class="text-center">
                    @if (Auth::user()->isClient())
                        <a href="{{ route(DETAIL_GAME_ROUTE, $order->game_id) }}" title="{{ trans('web.view_game') }}" class="btn btn-red-pink fw-bold ms-auto">
                            {{ trans('web.view_game') }}
                        </a>
                    @elseif (Auth::user()->isCreator())
                        <a href="{{ route(DETAIL_GAME_TEMPLATE_ROUTE, $order->gameTemplate->id) }}" title="{{ trans('web.view_game') }}" class="btn btn-red-pink fw-bold ms-auto">
                            {{ trans('web.view_game') }}
                        </a>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
