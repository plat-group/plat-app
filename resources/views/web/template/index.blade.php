@extends('web.layout')
@section('content')
    <div class="container">
    <div class="row gx-5">
        @for($i=1; $i <= 8; $i++)
            <div class="col-md-3 mb-3">
                <div class="box-game-item">
                    <div class="thumb-item mb-2">
                        <a href="#" title="">
                            <img src="https://via.placeholder.com/280x240" alt="" class="w-100"/>
                        </a>
                    </div>
                    <h5 class="">
                        <a href="#" title="">
                            He made his passenger captain of one
                        </a>
                    </h5>
                </div>
            </div>
        @endfor
    </div>
    <div class="row mt-4">
        <div class="col-md-2 btn-more-game d-grid mx-auto">
            <a href="#" title="" class="btn btn-red-pink btn-lg fw-bold">More Games</a>
            <div class="bottom-gradient"></div>
        </div>
    </div>
    </div>
@stop
