<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title_page', 'Plats')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link href="{{ mix('static/css/web/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('static/css/web/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
<!-- Menu -->
@if(env('APP_TYPE') == 2)
    @include('web.menus.learning')
@else
    @include('web.menus.game')
@endif
<div class="main-container py-5">
    <div class="container">
        @yield('content')
    </div>
</div>
<footer>
    <div class="container">
        <div class="row footer-container align-items-center">
            <div class="col-md-2 copyright text-white">
               Copyright © 2022 Plats
            </div>
            <div class="col ms-auto">
                <ul class="list-inline socials">
                    <li class="list-inline-item">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('js/'.app()->getLocale().'.js') }}"></script>
<script src="{{ mix('static/js/web/vendor.js') }}" type="text/javascript"></script>
<script src="{{ mix('static/js/web/app.js') }}" type="text/javascript"></script>
@stack('js')
</body>
</html>
