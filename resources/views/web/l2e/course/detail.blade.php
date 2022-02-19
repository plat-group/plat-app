@extends('web.layout')
@section('title_page') Course: {{ $course->name }} @stop
@section('content')
    <div class="row mb-5">
        <div class="col-md-6">
            <h1 class="course-name text-blue-ribbon">
                {{ $course->name }}
            </h1>
            <div class="course-desc text-neutral-2 text-justify fs-16">
                {{ $course->description }}
            </div>
        </div>
        <div class="col-md-6">
            {{--@include('web.campaign.referral_box', ['campaign' => []])--}}
            @if (Auth::user()->isReferraler())
                @include('web.campaign.referral_box')
            @else
            <div class="course-thumb" style="max-width: 300px">
                <img class="w-100" src="{{ $course->thumb_url }}" alt="{{ $course->name }}"/>
            </div>
            @endif
        </div>
    </div>
    <div class="lesson-list mb-5">
        @each('web.l2e.lesson.item_list', $course->lessons, 'lesson')
    </div>
@stop
