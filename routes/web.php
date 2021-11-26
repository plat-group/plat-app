<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Web\{Login, Register};
use App\Http\Controllers\Web\{Pool, Market, MyGame, MyOrder, Game, Campaign};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Authentication
Route::prefix('auth')->group(function () {
    Route::get('/login', [Login::class, 'showForm'])->name(LOGIN_ROUTE);
    Route::post('/login', [Login::class, 'login'])->name(LOGIN_ROUTE);
    Route::get('/logout', [Login::class, 'logout'])->name(LOGOUT_ROUTE);
    Route::get('/register', [Register::class, 'showForm'])->name(REGISTER_ROUTE);
    Route::post('/register', [Register::class, 'register'])->name(REGISTER_ROUTE);
});


//Pool
Route::get('/', [Pool::class, 'index'])->name(HOME_ROUTE);
Route::get('/pool', [Pool::class, 'index'])->name(POOL_GAME_ROUTE);

//Game
Route::prefix('games')->group(function () {
    Route::get('/{id}', [Game::class, 'show'])->name(DETAIL_GAME_ROUTE)->whereUuid('id');
});

// Campaign
Route::prefix('campaigns')->middleware('auth')->group(function () {
    Route::post('/', [Campaign::class, 'store'])->name(CREATE_CAMPAIGN_ROUTE);
});


//Market
Route::prefix('market')->group(function () {
    Route::get('/', [Market::class, 'index'])->name(MARKET_GAME_ROUTE);
    Route::get('/{id}', [Market::class, 'show'])->name(MARKET_GAME_DETAIL_ROUTE)->whereUuid('id');
    Route::post('/{id}/order', [Market::class, 'order'])->name(ORDER_GAME_ROUTE)->whereUuid('id');
});

// My Game
Route::prefix('my-games')->middleware('auth')->group(function () {
    Route::get('/', [MyGame::class, 'index'])->name(MY_GAME_ROUTE);
    Route::get('/{id}', [MyGame::class, 'show'])->name(DETAIL_GAME_TEMPLATE_ROUTE)->whereUuid('id');
    Route::get('/create', [MyGame::class, 'create'])->name(CREATE_GAME_ROUTE)->can('create', \App\Models\GameTemplate::class);
    Route::post('/store', [MyGame::class, 'store'])->name(STORE_TEMPLATE_GAME_ROUTE);
});

// My Order
Route::prefix('orders')->middleware('auth')->group(function () {
    Route::get('/', [MyOrder::class, 'index'])->name(MY_ORDER_GAME_ROUTE);
    Route::get('/{id}/confirms/{action}', [MyOrder::class, 'confirm'])->name(CONFIRM_ORDER_GAME_ROUTE)
        ->whereUuid('id')->where(['action' => ACCEPTED_ORDER_STATUS.'|'.DENIED_ORDER_STATUS]);
});
