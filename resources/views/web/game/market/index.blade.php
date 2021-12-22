@extends('web.layout')
@section('content')
    <div class="row gx-5">
        @foreach($games as $game)
            <div class="col-md-3 mb-3">
                @include('web.game._common.item_list', ['item' => $game])
            </div>
        @endforeach
    </div>
    @if ($games->hasMorePages())
    <div class="row mt-4">
        <div class="col-md-2 btn-more-game d-grid mx-auto">
            <a href="#" title="" class="btn btn-red-pink btn-lg fw-bold">More Games</a>
            <div class="bottom-gradient"></div>
        </div>
    </div>
    @endif
@stop
