@extends('web.layout')
@section('title_page') {{ trans('web.income_histories') }} @stop
@section('content')
    <x-alert/>
    <div class="alert alert-box-earned mb-4" role="alert">
        <h3 class="fw-bold mb-0">
            {{ trans('web.earned_token_label') }}
        </h3>
        <div class="box-total-number">
            <span>23,300 {{ CURRENCY_CODE }}</span>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-flat table-borderless table-striped table-mauve-400">
            <thead>
            <tr class="text-uppercase">
                <th class="py-3" scope="col">{{ trans('web.my_order_id') }}</th>
                <th class="py-3" scope="col"> {{ trans('web.client') }} </th>
                <th class="py-3" scope="col">{{ trans('web.game') }}</th>
                <th class="py-3" scope="col">{{ trans('web.earned_token') }}</th>
                <th class="py-3" scope="col">{{ trans('web.time') }}</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@stop
@push('css')
    <link href="{{ mix('static/css/web/pages/income_history.css') }}" rel="stylesheet">
@endpush
