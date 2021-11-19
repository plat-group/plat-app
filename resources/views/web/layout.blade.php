<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title_page', 'PlatChain - VAIX GROUP')</title>

    <!-- Fonts -->
    <link href="{{ mix('static/css/web/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('static/css/web/app.css') }}" rel="stylesheet">

    @yield('css')
</head>

<body>
    <header class="py-4">

        <div class="container">
            <div class="row ">
                <div class="col-3">
                    <a class="navbar-brand me-auto p-0" href="{{ url('') }}">
                        <img src="{{ asset('images/web/logo.svg') }}" alt="PlatChain" style="width: 193px; height: 80px" />
                    </a>
                </div>
                <div class="col-7 d-flex align-items-center justify-content-end">
                    <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <ul class="navbar-nav">
                            @foreach([
                            POOL_GAME_ROUTE => 'Pool',
                            TEMPLATE_GAME_ROUTE => 'Template',
                            MY_GAME_ROUTE => 'My game',
                            MY_ORDER_GAME_ROUTE => 'My order',
                            ] as $route => $name)
                            <li class="nav-item">
                                <a class="nav-link {{ (request()->routeIs($route)) ? 'active' : '' }}" aria-current="page" href="{{ route($route) }}">
                                    {{ $name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </nav>

                </div>

                <div class="col-2 d-flex align-items-center">
                    <div class="main-login">
                        @if(Auth::user())
                        <div class="box-user d-flex align-items-center">
                            <p class="name mb-0 mr-2">{{Auth::user()->name}}</p>
                            <i class="bi bi-caret-down-fill"></i>
                        </div>
                        <ul class="box-user-options">

                            <li><a href="#" class="" title="Profile">Profile</a></li>
                            <li><a href="{{route(LOGOUT_ROUTE)}}" class="" title="Logout">Logout</a></li>

                        </ul>
                        @else
                        <div class="box-login d-flex">
                            <a href="{{ route(LOGIN_ROUTE) }} " class="d-block me-2" title="Login">Login</a> /
                            <a href="{{ route(REGISTER_ROUTE) }}" class="d-block ms-2" title="Register">Register</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="main-container bg_order py-5">

        @yield('content')

    </div>
    <footer class="">
        <div class="container">
            <div class="row footer-container align-items-center">
                <div class="col-md-6 copyright text-white">
                    Copyright © 2021 Plats
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
    @yield('js')
</body>

</html>
