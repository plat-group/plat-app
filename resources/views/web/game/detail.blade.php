@extends('web.layout')
@section('title_page') {{ $game->name }} @stop
@section('content')
    <x-alert/>
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
            @includeWhen(optional(auth()->user())->can('createCampaign', $game),
                'web.game._forms.campaign', ['game' => $game])

            @includeWhen(optional(auth()->user())->can('referral', $game), 'web.game._forms.referral_box', ['game' => $game])
        </div>
        <div class="col-md-6">
            <div id="gameGallery" class="game-gallery carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ $game->thumb_url }}" class="d-block w-100" alt="...">
                    </div>
                    {{--
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/557x323" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://via.placeholder.com/557x323" class="d-block w-100" alt="...">
                    </div>
                    --}}
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
    <!-- For creator -->
    {{-- @includeWhen(Auth::user()->isCreator(), 'web.game._forms.detail_creator', ['game' => $game]) --}}

    <!-- For client -->
    {{-- @includeWhen(Auth::user()->isClient(), 'web.game._forms.detail_client', ['game' => $game]) --}}
@stop
