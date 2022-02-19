@extends('web.layout')
@section('title_page') Plats L2E @stop
@section('content')
    @if (Auth::user()->isCreator())
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route(MY_COURSE_ROUTE) }}" title="{{ trans('web.course_management') }}" class="btn btn-inner-glow rounded-pill fw-bold px-4 py-2">
            {{ trans('web.course_management') }}
        </a>
    </div>
    @endif
    <div class="row gx-5">
        @foreach($courses as $item)
            <div class="col-md-3 mb-3">
                <div class="box-game-item position-relative">
                    <div class="thumb-item mb-2">
                        <img src="{{ $item->thumb_url }}" alt="{{ $item->name }}" class="w-100"/>
                    </div>
                    <h5 class="mb-0">
                        <a href="{{ route(DETAIL_COURSE_ROUTE, $item->id) }}" title="{{ $item->name }}" class="stretched-link">
                            {{ $item->name }}
                        </a>
                    </h5>
                    <div class="text-muted">
                        By: <span class="link-red-pink">{{ $item->creator->name }}</span>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
@stop
