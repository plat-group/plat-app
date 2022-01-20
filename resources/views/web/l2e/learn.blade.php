
@extends('web.layout')
@section('title_page') Plats L2E @stop
@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <video controls id="learnVideo" class="w-100">
                {{-- <source src="{{ Storage::url('l2e-video/demo-video.webm') }}" type="video/webm"> --}}

                <source src="{{ Storage::url('l2e-video/what-is-near.mp4') }}"
                        type="video/mp4">
                Sorry, your browser doesn't support embedded videos.
            </video>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exercise2" tabindex="-1" aria-labelledby="exerciseLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-mauve-400">
                <div class="modal-body d-flex">
                    <div class="row justify-content-center w-100">
                        <div class="col-12 col-md-6 d-flex align-self-center">
                            <x-form::open action="#" class="form-default has_validate">
                            <div class="question h5 mb-3">
                                Content question content question content questioncontent question content question content question?
                            </div>
                            <div class="answer-options mb-5">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="answer1">
                                    <label class="form-check-label" for="answer1">
                                        Default radio
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Default checked radio
                                    </label>
                                </div>
                            </div>
                            <div class="send-answer d-grid gap-2 col-3 mx-auto">
                                <button type="button" id="send2" class="btn btn-primary">Send</button>
                            </div>
                            </x-form::open>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Remain for testing -->
    <div class="modal fade" id="exercise" tabindex="-1" role="dialog" aria-labelledby="exerciseLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-mauve-400">
            <div class="modal-body">
                    <div class="question h5 mb-3">
                        Content question content question content questioncontent question content question content question?
                    </div>
                    <div class="answer-options mb-5">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="answer1">
                            <label class="form-check-label" for="answer1">
                                Default radio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Default checked radio
                            </label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="send" class="btn btn-primary">Send</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Reward -->
    <div class="modal fade" id="reward" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-mauve-400">
                <div class="modal-header">
                    <h5 class="modal-title">Lesson Finish!</h5>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center w-100">
                        <div class="col-12 col-md-3 d-flex align-self-center">
                            Right
                        </div>
                        <div class="col-12 col-md-8 d-flex align-self-center">
                            <span class="box">2</span>
                        </div>
                    </div>
                    <div class="row justify-content-center w-100">
                        <div class="col-12 col-md-3 d-flex align-self-center">
                            Wrong
                        </div>
                        <div class="col-12 col-md-8 d-flex align-self-center">
                            <span class="box">4</span>
                        </div>
                    </div>
                    <div class="row justify-content-center w-100">
                        <div class="col-12 col-md-6 d-flex align-self-center">
                            <img src="/static/images/web/cup.png" alt="cup" class="cup-icon"/>
                            <img src="/static/images/web/cup.png" alt="cup" class="cup-icon"/>
                            <img src="/static/images/web/cup.png" alt="cup" class="cup-icon"/>
                        </div>
                    </div>
                    <div class="row justify-content-center w-100">
                        Congratulation. You've received <span class="earned"><strong>100</strong></span>Plats token.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal rewards -->
@stop
@push('css')
    <link href="{{ mix('static/css/web/pages/l2e.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ mix('static/js/web/pages/l2e.js') }}" type="text/javascript"></script>
@endpush
