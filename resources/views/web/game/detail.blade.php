@extends('web.layout')
@section('title_page') {{ $game->name }} @stop
@section('content')
    @if (optional(auth()->user())->can('pushToPool', $game))
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route(PUSH_TO_POOL_GAME_ROUTE, $game->id) }}" title="{{ trans('web.create_new_game') }}"
               class="btn btn-inner-glow rounded-pill fw-bold text-uppercase px-4 py-2">
                {{ trans('web.push_to_pool') }}
            </a>
        </div>
    @endif
    <div class="row gx-5">
        <div class="col-md-6">
            <h2 class="fw-bold text-red-pink mb-3">
                {{ $game->name }}
            </h2>
            <div class="game-introduction text-justify fs-16 mb-4">
                {{ $game->introduction }}
            </div>
            <div class="game-description text-justify fs-16">
                {{ $game->description }}
            </div>
            {{--@includeWhen(!$game->onMarket && $game->isOwner(auth()->id()), 'web.game._forms.publish_box')--}}
            @includeWhen(optional(auth()->user())->isClient() && $game->isOwner(auth()->user()->id) && $game->on_pool,
                'web.game._forms.campaign', ['game' => $game])
        </div>
        <div class="col-md-6">
            <div id="gameGallery" class="game-gallery carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://via.placeholder.com/557x323" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/557x323" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/557x323" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#gameGallery" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#gameGallery" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    @includeWhen(optional(auth()->user())->can('order', $game), 'web.game._forms.order', ['game' => $game])
@stop
