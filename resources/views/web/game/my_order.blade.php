@extends('web.layout')
@section('title_page') {{ trans('web.my_order') }} @stop
@section('content')
    <div class="table-responsive">
        <table class="table table-flat table-borderless table-striped table-mauve-400">
            <thead>
                <tr class="text-uppercase">
                    <th class="py-3" scope="col">ID</th>
                    <th class="py-3" scope="col">Creator</th>
                    <th class="py-3" scope="col">Order game</th>
                    <th class="py-3" scope="col">Order token</th>
                    <th class="py-3" scope="col">Token per play</th>
                    <th class="py-3" scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            @for ($i = 1; $i <= 20; $i++)
            <tr>
                <th class="text-center" scope="row">
                    {{ $i }}
                </th>
                <td class="text-center">Mark</td>
                <td class="">Funny car racing</td>
                <td class="text-end">1,000</td>
                <td class="text-end">5</td>
                <td class="">
                    <div class="hstack gap-3">
                        <span>Creating</span>
                        <a href="#" title="" class="btn btn-red-pink fw-bold ms-auto">
                            Push to pool
                        </a>
                    </div>
                </td>
            </tr>
            @endfor
            </tbody>
        </table>
    </div>
@stop
