@extends('web.layout')
@section('css')
<link rel="stylesheet" href="{{mix('static/css/web/pages/uploadGame.css')}}">
@endsection
@section('content')
<div class="container">
    <x-form::message />
    {{ Form::open(['route' => REGISTER_ROUTE, 'class' => 'form-upload-game has_validate']) }}

    <x-form::group class="required">
        <x-form::input type="text" name="name" class="required form-control-lg" placeholder="{{ trans('web.name') }}" />
    </x-form::group>

    <div class="row">
        <div class="col-8">
            <x-form::group class="required ">
                <textarea name="description" class="require form-control form-control-description" placeholder="Description"></textarea>
            </x-form::group>
        </div>
        <div class="col-4">
            <x-form::group class="required thumbnail">
                <label for="">
                    <p class="title">Drag and drop thumbnail</p>
                    <x-form::input type="file" name="" class="required form-control-lg" placeholder="{{ trans('web.password') }}" />
                </label>
            </x-form::group>
        </div>
    </div>

    <x-form::group class="required game-file">

        <label for="">
            <p class="title">Drag and drop game file</p>
            <x-form::input type="file" name="" class="required form-control-lg" placeholder="{{ trans('web.password') }}" />
        </label>
    </x-form::group>

    <div class="d-flex justify-content-center">
        <button class="btn btn-red-pink btn-lg fw-bold px-5">{{ trans('web.btn_upload') }}</button>
    </div>
    {{ Form::close() }}

</div>
@endsection
