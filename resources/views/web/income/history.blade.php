@extends('web.layout')
@section('title_page') {{ trans('web.income_histories') }} @stop
@section('content')
    <x-alert/>
    <div class="alert alert-box-earned mb-4" role="alert">
        <h3 class="fw-bold mb-0">
            {{ trans('web.earned_token_label') }}
        </h3>
        <div class="box-total-number">
            <span>{{ $totalEarned }} {{ CURRENCY_CODE }}</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-flat table-borderless table-striped table-primary-2">
            <thead>
            <tr class="text-uppercase">
                <th class="py-3" scope="col">{{ trans('web.my_order_id') }}</th>
                {{-- <th class="py-3" scope="col"> {{ trans('web.client') }} </th> --}}
                <th class="py-3" scope="col">{{ trans('web.game') }}</th>
                <th class="py-3" scope="col">{{ trans('web.earned_token') }}</th>
                <th class="py-3" scope="col">{{ trans('web.time') }}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td class="py-3 text-center" scope="col">{{ $loop->iteration }}</td>
                        {{-- <td class="py-3" scope="col">{{ $transaction-> }} </td> --}}
                        <td class="py-3" scope="col">{{ $transaction->campaign->game->name ?? '' }}</td>
                        <td class="py-3 text-end" scope="col">{{ $transaction->amount }}</td>
                        <td class="py-3 text-end" scope="col">{{ $transaction->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
@push('css')
    <link href="{{ mix('static/css/web/pages/income_history.css') }}" rel="stylesheet">
@endpush
