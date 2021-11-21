<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Web\{Login, Register};
use App\Http\Controllers\Web\{Pool, Template, MyGame};
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
Route::get('/template', [Template::class, 'index'])->name(TEMPLATE_GAME_ROUTE);
Route::resource('my-games', MyGame::class)->names([
    'index' => MY_GAME_ROUTE,
    'create' => CREATE_GAME_ROUTE,
    'store' => STORE_TEMPLATE_GAME_ROUTE,
])->middleware('auth');

Route::get('/my-orders', [Template::class, 'index'])->name(MY_ORDER_GAME_ROUTE)->middleware('auth');


