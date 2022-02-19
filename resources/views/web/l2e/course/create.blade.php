@extends('web.layout')
@section('title_page') Plats L2E - Create course @stop
@section('content')
<div class="row">
    <div class="col-12">
        <x-alert/>
    </div>
    <x-form::open action="{{ route(STORE_COURSE_ROUTE) }}" files="true" id="create-l2e" class="form-default create_l2e has_validate">
    <div class="col-12 col-md-10 mx-md-auto inner-box bg-mauve-400 rounded-3 p-4 mb-4">
        <x-form::group label="Title of course">
            <x-form::input name="name" class="rounded-3 bg-white text-black required"
                           placeholder="Input learning course title"/>
        </x-form::group>
        <x-form::group label="Course description">
            <x-form::textarea name="description" :value="old('description')" placeholder="Input learning course description" rows="7"
                              class="rounded-3 bg-white text-black required"/>
        </x-form::group>
        <div class="box-upload upload-file rounded-3">
            <label for="thumbnail" class="form-label align-self-center cursor-pointer">
                Thumbnail
            </label>
            <input class="form-control" type="file" name="thumbnail" id="thumbnail">
        </div>
    </div>
    <x-forms.input type="hidden" name="id" value="0"/>
    <div class="d-grid gap-2 col-3 mx-auto">
        <button class="btn btn-success" type="submit">Save</button>
    </div>
    </x-form::open>
</div>
@stop
@push('js')
    <script src="{{ mix('static/js/web/pages/l2e.js') }}" type="text/javascript"></script>
@endpush
