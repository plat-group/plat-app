@extends('web.layout')
@section('content')
    <div class="row gx-5">
        <div class="col-md-4 game-item-highlight">
            <div class="thumb-item mb-3">
                <a href="#" title="">
                    <img src="https://via.placeholder.com/375x272" alt="" class="w-100"/>
                </a>
            </div>
            <h4 class="item-name text-uppercase fw-bold mb-3">
                <a href="#" title="" class="link-red-pink">
                    HE MADE HIS PASSENGER CAPTAIN OF ONE
                </a>
            </h4>
            <div class="creator-item d-flex align-items-center mb-3">
                <div class="flex-shrink-0">
                    <img src="https://via.placeholder.com/44x44" alt="..." class="rounded-circle">
                </div>
                <div class="flex-grow-1 ms-2 fw-bold">
                    by <a href="#" title="" class="link-red-pink">Tim cook</a> at Jul 23, 2021
                </div>
            </div>
            <div class="description lh-lg">
                Just then her head struck against the roof of the hall: in fact she was now more than nine feet high, and she at once took up the little golden key and hurried off to the garden door. The first question of course was, how to get dry again
            </div>
        </div>
        <div class="col-md-8">
            <div class="row gx-5">
                @for($i=1; $i <= 6; $i++)
                <div class="col-md-4 mb-3">
                    <div class="box-game-item">
                        <div class="thumb-item mb-2">
                            <a href="#" title="">
                                <img src="https://via.placeholder.com/240x200" alt="" class="w-100"/>
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
        </div>
    </div>
@stop
