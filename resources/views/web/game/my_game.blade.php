@extends('web.layout')
@section('content')
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route(CREATE_GAME_ROUTE) }}" title="" class="btn btn-primary">
            {{ trans('web.create_new_game') }}
        </a>
    </div>
    <div class="row gx-5">
        @foreach($myGames as $game)
        <div class="col-md-3 mb-3">
            @include('web.game._common.item_list', ['item' => $game])
        </div>
        @endforeach
    </div>
    @if ($myGames->hasMorePages())
    <div class="row mt-4">
        <div class="col-md-2 btn-more-game d-grid mx-auto">
            <a href="{{ $myGames->nextPageUrl() }}" title="{{ trans('web.next_page_game') }}" class="btn btn-red-pink btn-lg fw-bold">
                {{ trans('web.next_page_game') }}
            </a>
            <div class="bottom-gradient"></div>
        </div>
    </div>
    @endif
@stop