<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Web\{Login, Register};
use App\Http\Controllers\Web\{Pool, Market, MyGame, MyOrder};
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

//Market
Route::prefix('market')->group(function () {
    Route::get('/', [Market::class, 'index'])->name(MARKET_GAME_ROUTE);
    Route::get('/{id}', [Market::class, 'show'])->name(MARKET_GAME_DETAIL_ROUTE)->whereUuid('id');
    Route::post('/{id}/order', [Market::class, 'order'])->name(ORDER_GAME_ROUTE)->whereUuid('id');
});

// My Game
Route::resource('my-games', MyGame::class)->names([
    'index' => MY_GAME_ROUTE,
    'show' => DETAIL_GAME_TEMPLATE_ROUTE,
    'create' => CREATE_GAME_ROUTE,
    'store' => STORE_TEMPLATE_GAME_ROUTE,
])->only(['index', 'show', 'create', 'store'])->middleware('auth');

// My Order
Route::prefix('orders')->middleware('auth')->group(function () {
    Route::get('/', [MyOrder::class, 'index'])->name(MY_ORDER_GAME_ROUTE);
});


