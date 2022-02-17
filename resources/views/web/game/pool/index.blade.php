@extends('web.layout')
@section('content')
    <div class="row gx-5">
        <div class="col-md-12">
            <div class="row gx-5">
                @foreach($games as $game)
                    <div class="col-md-3 mb-3">
                        @include('web.game._common.item_list', ['item' => $game])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
