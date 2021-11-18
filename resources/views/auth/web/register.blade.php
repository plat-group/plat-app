@extends('auth.web.auth_layout')
@section('auth_container')
    <x-form::message/>
    {{ Form::open(['route' => REGISTER_ROUTE, 'class' => 'register_form has_validate']) }}
    <div class="form-group mb-4">
        @foreach([CREATOR_ROLE, CLIENT_ROLE, REFERRAL_ROLE, USER_ROLE] as $roleCode)
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="kind" id="request_role_{{ $roleCode }}" @if($roleCode === 1) checked @endif  value="{{ $roleCode }}">
            <label class="form-check-label cursor-pointer fs-16 fw-bold" for="request_role_{{ $roleCode }}">
                {{ trans('web.roles.' . $roleCode) }}
            </label>
        </div>
        @endforeach
    </div>
    <x-form::group class="required">
        <x-form::input type="text" name="name" class="required form-control-lg" placeholder="{{ trans('web.name') }}"/>
    </x-form::group>
    <x-form::group class="required">
        <x-form::input type="email" name="email" class="required form-control-lg" placeholder="{{ trans('web.login_username') }}"/>
    </x-form::group>

    <x-form::group class="required">
        <x-form::input type="password" name="password" class="required form-control-lg" placeholder="{{ trans('web.password') }}"/>
    </x-form::group>

    <x-form::group class="required">
        <x-form::input name="sex" class="required form-control-lg" placeholder="{{ trans('web.sex') }}"/>
    </x-form::group>

    <x-form::group class="required">
        <x-form::input name="birthday" class="required form-control-lg" placeholder="{{ trans('web.birthday') }}"/>
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
