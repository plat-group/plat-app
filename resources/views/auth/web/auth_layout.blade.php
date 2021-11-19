<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlatChain - VAIX GROUP</title>

    <!-- Fonts -->
    <link href="{{ mix('static/css/web/vendor.css') }}" rel="stylesheet">
    @yield('css')
    <link href="{{ mix('static/css/web/app.css') }}" rel="stylesheet">
    <link href="{{ mix('static/css/web/pages/authentication.css') }}" rel="stylesheet">

</head>
<body>
<div class="auth-container container vh-100">
    <div class="row justify-content-center h-100">
        <div class="col-md-4 align-self-center">
            <div class="logo text-center mb-5">
                <a href="#" title="">
                    <img src="{{ asset('images/web/logo.svg') }}" alt="PlatChain" style="width: 281px; height: 117px"/>
                </a>
            </div>
            @yield('auth_container')
        </div>
    </div>
</div>
<script src="{{ asset('js/'.app()->getLocale().'.js') }}"></script>
<script src="{{ mix('static/js/web/vendor.js') }}" type="text/javascript"></script>
@yield('js')
<script src="{{ mix('static/js/web/app.js') }}" type="text/javascript"></script>

</body>
</html>
