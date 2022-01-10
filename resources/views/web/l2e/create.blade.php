@extends('web.layout')
@section('title_page') Plats L2E @stop
@section('content')
<div class="row">
    <x-form::open action="{{ route(STORE_L2E_ROUTE) }}" files="true" id="create-l2e" class="form-default create_l2e has_validate">
    <div class="col-12 col-md-10 mx-md-auto inner-box bg-mauve-400 rounded-3 p-4 mb-4">
        <x-form::group label="Upload video">
            <x-form::input name="video_url" class="rounded-3 bg-white text-black required"
                           placeholder="{{ trans('web.input_upload_video') }}"/>
        </x-form::group>
        <div class="repeater">
            <div data-repeater-list="timer-group">
                <div data-repeater-item class="shadow p-3 mb-3">
                    <div  class="row">
                        <div class="col-4">
                            <x-form::group label="Stop time">
                                <x-form::input name="stop_time[]" class="rounded-3 text-white required js-stop-time mb-0"
                                       placeholder="00:00:00"/>
                            </x-form::group>
                        </div>
                        <div class="col-2 mt-auto mb-4">
                            <input data-repeater-delete type="button" class="btn btn-sm btn-outline-danger" value="x Clear question"/>
                        </div>
                    </div>
                    <x-form::group label="Enter question">
                        <x-form::input name="question" class="rounded-3 text-white required"
                               placeholder="Content"/>
                    </x-form::group>
                    <div class="inner-repeater ps-3">
                        <div data-repeater-list="answer-list" class="">
                            <div data-repeater-item class="row mb-2">
                                <div class="col-5">
                                    <x-form::input name="question" class="rounded-3 text-white required"
                                                   placeholder="Answer"/>
                                </div>
                                <div class="col-2 d-flex align-items-center px-0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input js-check-correct" type="checkbox" value="1" name="is_correct" checked>
                                        <label class="form-check-label">Is Correct</label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <input data-repeater-delete type="button" class="btn btn-sm btn-outline-danger" value="x Delete"/>
                                </div>
                            </div>
                        </div>
                        <input data-repeater-create type="button" value="Add answer +" class="btn btn-sm btn-outline-success"/>
                    </div>
                </div>
            </div>
            <input data-repeater-create type="button" class="btn btn-outline-primary" value="+ Add Stop"/>
        </div>
    </div>
    <div class="d-grid gap-2 col-3 mx-auto">
        <button class="btn btn-success" type="submit">Done</button>
    </div>
    </x-form::open>
</div>
@stop
@push('js')
    <script src="{{ mix('static/js/web/pages/l2e.js') }}" type="text/javascript"></script>
@endpush
