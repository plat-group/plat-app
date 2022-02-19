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
            @include('web.campaign.referral_box', ['campaign' => []])
            {{--@if (Auth::user()->isReferraler())
                @include('web.game._forms.referral_box')
            @else
            <div class="course-thumb" style="max-width: 300px">
                <img class="w-100" src="{{ $course->thumb_url }}" alt="{{ $course->name }}"/>
            </div>
            @endif--}}
        </div>
    </div>
    <div class="lesson-list">
        @for ($i = 1; $i < 5; $i++)
            <div class="card text-white bg-mauve-400 mb-3">
                <div class="row g-0">
                    <div class="col-md-8 p-4">
                        <div class="row h-100">
                            <div class="col-12 lesson-content">
                                <h5 class="fw-bold">
                                    Lesson {{ $i }}
                                </h5>
                                <div class="lesson-desc">
                                    Learner can get basic knowleage about NEAR and can create simple smart contract
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="https://via.placeholder.com/360x205" class="img-fluid w-100 rounded-end" alt="...">
                    </div>

                </div>
            </div>
        @endfor
    </div>
@stop
