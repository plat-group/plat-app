@extends('web.layout')
@section('title_page') Plats L2E @stop
@section('content')
<div class="row">
    <x-form::open action="{{ route(STORE_L2E_COURSE_ROUTE) }}" files="true" id="create-l2e" class="form-default create_l2e has_validate">
    <div class="col-12 col-md-10 mx-md-auto inner-box bg-mauve-400 rounded-3 p-4 mb-4">
        <x-form::group label="Title of lesson">
            <x-form::input name="title" class="rounded-3 bg-white text-black required"
                placeholder="Lesson title"/>
        </x-form::group>
        <x-form::group label="Upload video">
            {{-- <x-form::file name="video_url" class="rounded-3 bg-white text-black required"
                        placeholder="{{ trans('web.input_upload_video') }}"/> --}}
            <div  class="row">
                <div class="col-7">
                    <input class="rounded-3 bg-white text-black required" type="file" name="video_url" id="videoUrl">
                </div>
                <div class="col-4 mt-auto mb-4">
                    <video width="320" height="240" controls>
                    Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </x-form::group>
        <div class="repeater">
            <div data-repeater-list="timer-group">
                <div data-repeater-item class="shadow p-3 mb-3">
                    <div  class="row">
                        <div class="col-4">
                            <x-form::group label="Stop time">
                                <x-form::input name="stop_time[]" class="rounded-3 bg-white text-black required js-stop-time mb-0"
                                    placeholder="00:00:00"/>
                            </x-form::group>
                        </div>
                        <div class="col-2 mt-auto mb-4">
                            <input data-repeater-delete type="button" class="btn btn-sm btn-outline-danger" value="x Clear question"/>
                        </div>
                    </div>
                    <x-form::group label="Enter question">
                        <x-form::input name="question" class="rounded-3 bg-white text-black required"
                            placeholder="Content"/>
                    </x-form::group>
                    <div class="inner-repeater ps-3">
                        <div data-repeater-list="answer-list" class="">
                            <div data-repeater-item class="row mb-2">
                                <div class="col-5">
                                    <x-form::input name="question" class="rounded-3 bg-white text-black required"
                                                placeholder="Answer"/>
                                </div>
                                <div class="col-2 d-flex align-items-center px-0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input js-check-correct" type="checkbox" value="1" name="is_correct" checked>
                                        <label class="form-check-label">Correct answer</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <input data-repeater-delete type="button" class="btn btn-sm btn-outline-danger" value="x Delete"/>
                                </div>
                            </div>
                        </div>
                        <input data-repeater-create type="button" value="+ Add answer" class="btn btn-sm btn-outline-success"/>
                    </div>
                </div>
            </div>
            <input data-repeater-create type="button" class="btn btn-outline-primary" value="+ Add Question"/>
        </div>
        {{-- <input data-repeater-create type="button" id="aa" class="btn btn-outline-primary" value="+ Add Lesson"/> --}}
    </div>
    <input type="hidden" id="create-mode" name="mode" >
    <div class="d-grid gap-2 col-3 mx-auto">
        <button class="btn btn-success" type="submit" id="btn-new-lesson">Save & Create another lesson</button>
        <button class="btn btn-success" type="submit">Finish</button>
    </div>
    </x-form::open>
    {{--<?php
phpinfo();
?>--}}
</div>
@stop
@push('js')
    <script src="{{ mix('static/js/web/pages/l2e.js') }}" type="text/javascript"></script>
    <script>
        $('#btn-new-lesson').click(function(e){
            e.preventDefault();
            $('#create-mode').val('new-lesson');
            $('form').submit();
        });

        document.getElementById("videoUrl").onchange = function(event) {
            let file = event.target.files[0];
            let blobURL = URL.createObjectURL(file);
            document.querySelector("video").src = blobURL;
        }
    </script>
@endpush
