<header class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-2 me-auto order-1">
                <a class="app-brand p-0" href="{{ url('') }}">
                    <img src="{{ asset('images/web/logo_learninghub.png') }}" alt="PlatChain" class="w-100"/>
                </a>
            </div>
            <div class="col-12 col-md-6 align-self-md-center mt-4 mt-md-0 order-3 order-md-2">
                <ul class="menu-header list-unstyled list-inline mb-0">
                    @if(displayMenuDashboard())
                        <li class="list-inline-item menu-item">
                            <a href="{{ route(MY_TRANSACTION_ROUTE) }}" title="{{ trans('web.learning.menu.dashboard')}}"
                                @class(['menu-link', 'active' => request()->routeIs(MY_TRANSACTION_ROUTE)])>
                                {{ trans('web.learning.menu.dashboard') }}
                            </a>
                        </li>
                    @endif
                    @if(displayMenuMarket())
                        <li class="list-inline-item menu-item">
                            <a href="{{ route(MARKET_GAME_ROUTE) }}" title="{{ trans('web.learning.menu.market')}}"
                                @class(['menu-link',
                                    'active' => request()->routeIs(HOME_ROUTE, MARKET_GAME_ROUTE, MARKET_GAME_DETAIL_ROUTE)])>
                                {{ trans('web.learning.menu.market') }}
                            </a>
                        </li>
                    @endif
                    @if(displayMenuPool())
                        <li class="list-inline-item menu-item">
                            <a href="{{ route(POOL_GAME_ROUTE) }}" title="{{ trans('web.learning.menu.hub')}}"
                                @class(['menu-link', 'active' => request()->routeIs(POOL_GAME_ROUTE, DETAIL_GAME_ROUTE)])>
                                {{ trans('web.learning.menu.hub') }}
                            </a>
                        </li>
                    @endif
                    @if(displayMenuMyGame())
                        <li class="list-inline-item menu-item">
                            <a href="{{ route(MY_GAME_ROUTE) }}" title="{{ trans('web.learning.menu.my_content')}}"
                                @class(['menu-link', 'active' => request()->routeIs(MY_GAME_ROUTE, CREATE_GAME_ROUTE, DETAIL_GAME_TEMPLATE_ROUTE)])>
                                {{ trans('web.learning.menu.my_content') }}
                            </a>
                        </li>
                    @endif
                    @if(displayMenuMyOrder())
                        <li class="list-inline-item menu-item">
                            <a href="{{ route(MY_ORDER_GAME_ROUTE) }}" title="{{ trans('web.learning.menu.my_order')}}"
                                @class(['menu-link', 'active' => request()->routeIs(MY_ORDER_GAME_ROUTE)])>
                                {{ trans('web.learning.menu.my_order') }}
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
