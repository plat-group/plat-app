@extends('auth.web.auth_layout')
@section('auth_container')
    <x-form::message/>
    {{ Form::open(['route' => REGISTER_ROUTE, 'class' => 'register_form has_validate']) }}
    <div class="form-group mb-4">
        @foreach(trans('app.roles') as $roleId => $roleName)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="request_role"
                   id="request_role_{{ $roleId }}" value="{{ $roleId }}"
                {{ (is_null(old('request_role')) && $roleId == USER_ROLE) || old('request_role') == $roleId ? 'checked' : ''  }}>
            <label class="form-check-label cursor-pointer fs-16 fw-bold" for="request_role_{{ $roleId }}">
                {{ $roleName }}
            </label>
        </div>
        @endforeach
    </div>
    <x-form::group class="required">
        <x-form::input name="name" class="required form-control-lg" placeholder="{{ trans('web.your_name') }}"/>
    </x-form::group>
    <x-form::group class="required">
        <x-form::input type="email" name="email" class="required form-control-lg" placeholder="{{ trans('web.login_username') }}"/>
    </x-form::group>

    <x-form::group class="required">
        <x-form::input type="password" name="password" class="required form-control-lg" placeholder="{{ trans('web.password') }}"/>
    </x-form::group>

    <x-form::group class="required">
        <x-form::select name="gender" class="required form-select-lg" :list="trans('app.genders')" selected="{{ MALE_GENDER }}"/>
    </x-form::group>

    <x-form::group class="required">
        <x-form::input name="birthday" class="required form-control-lg" placeholder="{{ trans('web.birthday') }}" readonly=""
                       data-toggle="date" data-maxDate="0"/>
    </x-form::group>

    <div class="d-flex justify-content-center">
        <button class="btn btn-red-pink btn-lg fw-bold px-5">{{ trans('web.btn_signup') }}</button>
    </div>
    {{ Form::close() }}

    <div class="register-box alert alert-gray-400 fs-16 text-black rounded-0 text-center mt-5" role="alert">
        {{ trans('web.need_login') }}
        <a href="{{ route(LOGIN_ROUTE) }}" title="{{ trans('web.have_account_need_login') }}" class="link-primary">
            {{ trans('web.have_account_need_login') }}
        </a>
    </div>
@stop
