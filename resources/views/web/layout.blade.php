<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title_page', 'Plats-GameHub')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link href="{{ mix('static/css/web/vendor.css') }}" rel="stylesheet">
    <link href="{{ mix('static/css/web/app.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body>
<header class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-2 me-auto order-1">
                <a class="app-brand p-0" href="{{ url('') }}">
                    <img src="{{ asset('images/web/logo_gamehub.png') }}" alt="PlatChain" class="w-100"/>
                </a>
            </div>
            <div class="col-12 col-md-6 align-self-md-center mt-4 mt-md-0 order-3 order-md-2">
                <ul class="menu-header list-unstyled list-inline mb-0">
                    @if(displayMenuDashboard())
                        <li class="list-inline-item menu-item">
                            <a href="{{ route(MY_TRANSACTION_ROUTE) }}" title="{{ trans('web.dashboard')}}"
                                @class(['menu-link', 'active' => request()->routeIs(MY_TRANSACTION_ROUTE)])>
                                {{ trans('web.dashboard') }}
                            </a>
                        </li>
                    @endif
                    @if(displayMenuMarket())
                        <li class="list-inline-item menu-item">
                            <a href="{{ route(MARKET_GAME_ROUTE) }}" title="{{ trans('web.market')}}"
                                @class(['menu-link',
                                    'active' => request()->routeIs(HOME_ROUTE, MARKET_GAME_ROUTE, MARKET_GAME_DETAIL_ROUTE)])>
                                {{ trans('web.market') }}
                            </a>
                        </li>
                    @endif
                    @if(displayMenuPool())
                        <li class="list-inline-item menu-item">
                            <a href="{{ route(POOL_GAME_ROUTE) }}" title="{{ trans('web.pool')}}"
                                @class(['menu-link', 'active' => request()->routeIs(POOL_GAME_ROUTE, DETAIL_GAME_ROUTE)])>
                                {{ trans('web.pool') }}
                            </a>
                        </li>
                    @endif
                    @if(displayMenuMyGame())
                        <li class="list-inline-item menu-item">
                            <a href="{{ route(MY_GAME_ROUTE) }}" title="{{ trans('web.my_game')}}"
                                @class(['menu-link', 'active' => request()->routeIs(MY_GAME_ROUTE, CREATE_GAME_TEMPLATE_ROUTE, DETAIL_GAME_TEMPLATE_ROUTE)])>
                                {{ trans('web.my_game') }}
                            </a>
                        </li>
                    @endif
                    @if(displayMenuMyOrder())
                        <li class="list-inline-item menu-item">
                            <a href="{{ route(MY_ORDER_GAME_ROUTE) }}" title="{{ trans('web.my_order')}}"
                                @class(['menu-link', 'active' => request()->routeIs(MY_ORDER_GAME_ROUTE)])>
                                {{ trans('web.my_order') }}
                            </a>
                        </li>
                    @endif
                    @guest
                        <li class="list-inline-item menu-item signed-out">
                            <a id="sign-in" class="menu-link" href="{{ route(LOGIN_ROUTE) }}" title="{{ trans('web.login')}}">
                                {{ trans('web.login')}}
                            </a>
                        </li>
                        {{--
                        <li class="list-inline-item menu-item">
                            <a class="menu-link" href="#" title="{{ trans('web.register')}}">
                                {{ trans('web.register')}}
                            </a>
                        </li>
                        --}}
                    @endguest
                </ul>
            </div>
         @auth
            <div class="col-3 col-md-1 align-self-center order-2 order-md-3 signed-in">
                <div class="dropdown-toggle cursor-pointer"
                   id="userDropbox" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                    <img src="{{auth()->user()->avatar ? '/upload/' . auth()->user()->avatar : '/static/images/web/avatar.png'}}" alt="" class="rounded-circle" style="width: 50px;"/>
                </div>
                <ul class="dropdown-menu" aria-labelledby="userDropbox">
                    <li>
                       <span class="dropdown-item-text fw-bold">{{ auth()->user()->name }} </span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="#" class="" title="{{ trans('web.profile') }}">
                            {{ trans('web.profile') }}
                        </a>
                    </li>
                    <li>
                         <a class="dropdown-item" href="{{ route(LOGOUT_ROUTE) }}" title="{{ trans('web.logout') }}">
                            {{ trans('web.logout') }}
                        </a>
                    </li>
                </ul>
            </div>
         @endauth
        </div>
    </div>
</header>
<div class="main-container py-5">
    <div class="container">
        @yield('content')
    </div>
</div>
<footer>
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
@stack('js')
</body>
</html>
