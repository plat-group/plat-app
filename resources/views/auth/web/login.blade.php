@extends('auth.web.auth_layout')
@section('auth_container')
    <x-alert/>
    {{ Form::open(['route' => LOGIN_ROUTE, 'class' => 'has_validate']) }}
    <x-form::group class="required">
        <x-form::input type="email" name="email" class="required form-control-lg" placeholder="{{ trans('web.login_username') }}"/>
    </x-form::group>
    <x-form::group class="required">
        <x-form::input type="password" name="password" class="required form-control-lg" placeholder="{{ trans('web.password') }}"/>
    </x-form::group>

    <p>
        <a href="#" title="{{ trans('web.link_forgot_pass') }}" class="text-decoration-underline">
            {{ trans('web.link_forgot_pass') }}
        </a>
    </p>
    <div class="d-flex justify-content-center">
        <button class="btn btn-red-pink btn-lg fw-bold px-5">{{ trans('web.btn_login') }}</button>
    </div>
    {{ Form::close() }}

    <div class="register-box alert alert-gray-400 fs-16 text-black rounded-0 text-center mt-5" role="alert">
        {{ trans('web.need_create_acc') }}
        <a href="{{ route(REGISTER_ROUTE) }}" title="{{ trans('web.link_create_acc') }}" class="link-primary">
            {{ trans('web.link_create_acc') }}
        </a>
    </div>

    <div class="register-box alert alert-gray-400 fs-16 text-black rounded-0 text-center mt-5" role="alert">
        <button id="sign-in" class="signed-out">
            Sign in with NEAR!
        </button>

    </div>
    <p class="signed-in">
      Signed in as <a id="account-id" href="https://wallet.testnet.near.org/profile" target="_blank"></a>
      • <a href="#signout" id="sign-out">sign out</a>
    </p>
@stop
@section('js')
    <script src="{{ mix('static/js/chain/main.js') }}" type="text/javascript"></script>
@endsection
