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
                </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
            <tr>
                <th class="text-center" scope="row">
                    {{ $loop->iteration }}
                </th>
                <td class="text-center">
                    {{ Auth::user()->isCreator() ? $order->client->name : $order->game->creator->name }}
                </td>
                <td class="">{{ $order->game->name }}</td>
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
                        @if (Auth::user()->isClient() && $order->canPushToPool())
                            <a href="#" title="" class="btn btn-red-pink fw-bold ms-auto">
                                Push to pool
                            </a>
                        @endif
                        @if (Auth::user()->isCreator() && $order->status == ORDERING_ORDER_STATUS)
                            <a href="#" title="" class="btn btn-red-pink fw-bold ms-auto px-3">
                                Accept
                            </a>
                            <a href="#" title="" class="btn btn-mauve-400 fw-bold px-3">
                                Deny
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
