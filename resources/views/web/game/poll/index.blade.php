@extends('web.layout')
@section('content')
    <div class="row gx-5">
        <div class="col-md-4 game-item-highlight">
            <div class="thumb-item mb-3">
                <a href="#" title="">
                    <img src="/upload/game_template/1ec540bf-d6ed-6c1e-9668-0202a0fb081a/bike.png" alt="" class="w-100"/>
                </a>
            </div>
            <h4 class="item-name text-uppercase fw-bold mb-3">
                <a href="#" title="" class="link-red-pink">
                DIRT5
                </a>
            </h4>
            <div class="creator-item d-flex align-items-center mb-3">
                <div class="flex-shrink-0">
                    <img src="https://via.placeholder.com/44x44" alt="..." class="rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 fw-bold">
                    by <a href="#" title="" class="link-red-pink">Yatta</a> at Nov 23, 2021
                </div>
            </div>
            <div class="description lh-lg">
            DIRT 5 is a fun, amplified, off-road arcade racing experience
            </div>
        </div>
        <div class="col-md-8">
            <div class="row gx-5">
                @foreach($games as $game)
                    <div class="col-md-4 mb-3">
                        @include('web.game._common.item_list', ['item' => $game])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
