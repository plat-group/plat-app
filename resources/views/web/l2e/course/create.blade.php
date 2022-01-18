@extends('web.layout')
@section('title_page') Plats L2E - create course @stop
@section('content')
<div class="row">
    <x-form::open action="{{ route(CREATE_STEP2_L2E_COURSE_ROUTE) }}" files="true" id="create-l2e" class="form-default create_l2e has_validate">
    <div class="col-12 col-md-10 mx-md-auto inner-box bg-mauve-400 rounded-3 p-4 mb-4">
        <div data-repeater-list="timer-group">
            <div data-repeater-item class="shadow p-3 mb-3">
                <x-form::group label="Title of course">
                    <x-form::input name="title" class="form-control-lg bg-white text-black rounded-3 required"
                        placeholder="Input learning course title"/>
                </x-form::group>
                <x-form::group label="Course description">
                    <x-form::textarea name="description" :value="old('description')" placeholder="Input learning course description" rows="7"
                        class="form-control-lg bg-white text-black rounded-3 required" :data-rule-maxlength="FORM_INPUT_MAX_LENGTH"/>
                </x-form::group>
            </div>
        </div>
    </div>
    <div class="d-grid gap-2 col-3 mx-auto">
        <button class="btn btn-success" type="submit">Next</button>
    </div>
    </x-form::open>
</div>
@stop
@push('js')
    <script src="{{ mix('static/js/web/pages/l2e.js') }}" type="text/javascript"></script>
@endpush
