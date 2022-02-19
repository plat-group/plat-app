<?php

if (!defined('DEFINE_CONSTANT')) {
    define('DEFINE_CONSTANT', 'DEFINE_CONSTANT');

    define('TOKEN_SYMBOL', 'Plt');
    define('PAGE_SIZE', 20);
    define('FORM_INPUT_MAX_LENGTH', 255);

    /**
     * Genders
     */
    define('MALE_GENDER', 1);
    define('FEMALE_GENDER', 2);
    /**
     * List role of application
     */
    define('USER_ROLE', 1);
    define('CREATOR_ROLE', 2);
    define('CLIENT_ROLE', 3);
    define('REFERRAL_ROLE', 4);
    define('ADMIN_ROLE', 9);

    /**
     * Game status
     */
    define('CREATING_GAME_STATUS', 1);
    define('FINISHED_CREATING_GAME_STATUS', 8);
    define('ON_MARKET_GAME_STATUS', 9);
    define('ON_POOL_GAME_STATUS', 10);

    /**
     * Order status
     */
    define('ORDERING_ORDER_STATUS', 1);
    //For Creator confirm
    define('ACCEPTED_ORDER_STATUS', 2);
    define('DENIED_ORDER_STATUS', 3);
    define('FINISH_ORDER_STATUS', 9);

    /**
     * Campaign
     */
    define('MIN_AMOUNT_CAMPAIGN', 0.001);
    define('CAMPAIGN_GAME', 1);
    define('CAMPAIGN_LEARN', 2);
}
