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

    /**
     * My Game routes
     */
    define('MY_GAME_ROUTE', 'game.my.route');
    define('CREATE_GAME_TEMPLATE_ROUTE', 'game.create.template.route');
    define('STORE_TEMPLATE_GAME_ROUTE', 'game.store.template.route');
    define('DETAIL_GAME_TEMPLATE_ROUTE', 'game.detail.template.route');

    /**
     * My Order routes
     */
    define('MY_ORDER_GAME_ROUTE', 'order.route');
    define('SHOW_ORDER_GAME_ROUTE', 'order.show.route');
    define('ORDER_STORE_GAME_ROUTE', 'order.store.game.route');
    define('CONFIRM_ORDER_GAME_ROUTE', 'order.confirm.route'); // For Creator
    define('ORDER_DOWNLOAD_RESOURCE_ROUTE', 'order.download.resource.route'); // For Creator

    /**
     * Game
     * All game has been push to pool
     */
    define('CREATE_GAME_ROUTE', 'game.create.route');
    define('STORE_GAME_ROUTE', 'game.store.route');
    define('DETAIL_GAME_ROUTE', 'game.detail.route');
    define('PLAY_GAME_ROUTE', 'game.play.route');
    define('FINISH_GAME_ROUTE', 'game.finish.route');

    /**
     * Campaign routes
     */
    define('CREATE_CAMPAIGN_ROUTE', 'campaign.creat.route');
    define('GENERATE_LINK_CAMPAIGN_ROUTE', 'campaign.generate_link.route');

    /**
     * User/Referral/Creator transaction (income history)
     */
    define('MY_TRANSACTION_ROUTE', 'transaction.route');

    /**
     * Learn to Earn
     */
    define('L2E_ROUTE', 'l2e.route');
    define('CREATE_L2E_ROUTE', 'l2e.create.route');
    define('STORE_L2E_ROUTE', 'l2e.store.route');
    define('MY_COURSE_ROUTE', 'l2e.course.management.route');
    define('CREATE_COURSE_ROUTE', 'l2e.course.create.route');
    define('STORE_COURSE_ROUTE', 'l2e.course.store.route');
    define('CREATE_STEP2_L2E_COURSE_ROUTE', 'l2e.create.step2.course.route');
    define('PLAY_LEARN_ROUTE', 'l2e.play.course.route');
}
