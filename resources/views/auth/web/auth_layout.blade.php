<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plats - GameHub</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link href="{{ mix('static/css/web/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('static/css/web/app.css') }}" rel="stylesheet">
    <link href="{{ mix('static/css/web/pages/authentication.css') }}" rel="stylesheet">
</head>
<body>
<div class="auth-container container vh-100">
    <div class="row justify-content-center h-100">
        <div class="col-md-5 align-self-center">
            <div class="logo text-center mb-2">
                <a href="{{ url('') }}" title="">
                    <img src="{{ asset('images/web/logo.svg') }}" alt="Plats" style="width: 281px; height: 117px"/>
                </a>
            </div>
            @yield('auth_container')
        </div>
    </div>
</div>
<script src="{{ asset('js/'.app()->getLocale().'.js') }}"></script>
<script src="{{ mix('static/js/web/vendor.js') }}" type="text/javascript"></script>
<script src="{{ mix('static/js/web/app.js') }}" type="text/javascript"></script>
@stack('js')
</body>
</html>
