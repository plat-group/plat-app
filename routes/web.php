<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Web\{Login, Register};
use App\Http\Controllers\Web\Client;
use App\Http\Controllers\Web\Creator;
use App\Http\Controllers\Web\Pool;
use App\Http\Controllers\Web\Template;

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
    Route::get('/login', [Login::class, 'showForm'])->name(LOGIN_ROUTE)->middleware('guest');
    Route::post('/login', [Login::class, 'login'])->name(LOGIN_ROUTE);
    Route::get('/register', [Register::class, 'showForm'])->name(REGISTER_ROUTE);
    Route::post('/register', [Register::class, 'register'])->name(REGISTER_ROUTE);
    Route::get('/logout', [Login::class, 'logout'])->name(LOGOUT_ROUTE);
});


//Pool


Route::get('/', [Pool::class, 'index'])->name(HOME_ROUTE);
Route::get('/pool', [Pool::class, 'index'])->name(POOL_GAME_ROUTE);
Route::get('/template', [Template::class, 'index'])->name(TEMPLATE_GAME_ROUTE);
Route::get('/my-games', [Client::class, 'myGame'])->name(MY_GAME_ROUTE)->middleware('auth');
Route::get('/my-orders', [Client::class, 'myOrder'])->name(MY_ORDER_GAME_ROUTE)->middleware('auth');
Route::get('/upload-game', [Creator::class, 'uploadGame'])->name(UPLOAD_GAME_ROUTE);
Route::get('/game-detail', [Creator::class, 'uploadGame'])->name(UPLOAD_GAME_ROUTE);
Route::get('/game-order', function () {
    return view('web.gameOrder.index');
});


