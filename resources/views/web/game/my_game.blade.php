@extends('web.layout')
@section('content')
@if (Auth::user()->isCreator())
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route(CREATE_GAME_ROUTE) }}" title="{{ trans('web.create_new_game') }}" class="btn btn-inner-glow rounded-pill fw-bold px-4 py-2">
            {{ trans('web.create_new_game') }}
        </a>
    </div>
@endif
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
            <a href="{{ $games->nextPageUrl() }}" title="{{ trans('web.next_page_game') }}" class="btn btn-red-pink btn-lg fw-bold">
                {{ trans('web.next_page_game') }}
            </a>
            <div class="bottom-gradient"></div>
        </div>
    </div>
    @endif
@stop
