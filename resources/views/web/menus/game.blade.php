<header class="pb-2">
    <div class="container">
        <div class="row py-2 text-center">
            <div class="col-3 col-md-2 me-auto order-1">
                <a class="app-brand p-0" href="{{ url('') }}">
                    <img src="{{ asset('images/web/logo_gamehub.png') }}" alt="PlatChain" class="w-100 h-100"/>
                </a>
            </div>
            <div class="col-6 col-md-9 align-self-md-center mt-4 mt-md-0 order-3 order-md-2">
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
                                @class(['menu-link', 'active' => request()->routeIs(MY_GAME_ROUTE, CREATE_GAME_ROUTE, DETAIL_GAME_TEMPLATE_ROUTE)])>
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
                    
                </ul>
            </div>

      
        <div class="col-3 col-md-1 align-self-center order-2 order-md-3 menu-header signed-in">
            @guest
                <li class="list-inline-item menu-item text-decoration-underline">
                    <a id="sign-in" class="menu-link fw-normal" href="{{ route(LOGIN_ROUTE) }}" title="{{ trans('web.login')}}">
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


            @auth
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
            @endauth

            </div>
        </div>
    </div>
</header>
