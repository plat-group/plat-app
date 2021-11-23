<?php

if (!defined('DEFINE_FRONTEND_ROUTER')) {
    define('DEFINE_FRONTEND_ROUTER', 'DEFINE_FRONTEND_ROUTER');

    define('HOME_ROUTE', 'home.route');
    define('POOL_GAME_ROUTE', 'game.pool.route');
    /**
     * For Market routes
     */
    define('MARKET_GAME_ROUTE', 'game.market.route');
    define('MARKET_GAME_DETAIL_ROUTE', 'game.market.detail.route');
    define('ORDER_GAME_ROUTE', 'game.order.route');

    //My Game
    define('MY_GAME_ROUTE', 'game.my.route');
    define('CREATE_GAME_ROUTE', 'game.create.route');
    define('STORE_TEMPLATE_GAME_ROUTE', 'game.store.template.route');
    define('DETAIL_GAME_TEMPLATE_ROUTE', 'game.detail.template.route');

    define('MY_ORDER_GAME_ROUTE', 'game.my_order.route');
}
