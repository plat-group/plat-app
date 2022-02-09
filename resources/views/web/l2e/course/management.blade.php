@extends('web.layout')
@section('title_page') Plats L2E @stop
@section('content')
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route(CREATE_COURSE_ROUTE) }}" title="{{ trans('web.create_new_course') }}" class="btn btn-inner-glow rounded-pill fw-bold px-4 py-2">
            {{ trans('web.create_new_course') }}
        </a>
    </div>

@stop
