<?php

use App\Http\Controllers\Auth\Web\{
    Login,
    Register};
use App\Http\Controllers\Web\{
    Campaign,
    Game,
    LearningCourse,
    Market,
    MyGame,
    MyOrder,
    Pool,
    Transaction,
    LearnToEarn
};
use Illuminate\Support\Facades\Route;

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

// Landing page
// Route::get('/', function () {
//     return view('lp.index');
// });

// Authentication
Route::prefix('auth')->group(function () {
    Route::get('/login', [Login::class, 'showForm'])->name(LOGIN_ROUTE);
    Route::post('/login', [Login::class, 'login'])->name(LOGIN_ROUTE);
    Route::get('/logout', [Login::class, 'logout'])->name(LOGOUT_ROUTE);
    Route::get('/register/{nearUsername}', [Register::class, 'showForm'])->name(REGISTER_ROUTE);
    Route::post('/register', [Register::class, 'register'])->name(REGISTER_ROUTE);
});


//Pool
Route::get('/', [Market::class, 'index'])->name(HOME_ROUTE);
// Route::get('/app', [Pool::class, 'index'])->name(HOME_ROUTE);
Route::get('/pool', [Pool::class, 'index'])->name(POOL_GAME_ROUTE);

//Game
Route::prefix('games')->group(function () {
    Route::get('/{game}', [Game::class, 'show'])->name(DETAIL_GAME_ROUTE)->whereUuid('game');
    Route::get('/create/{order}', [Game::class, 'create'])->name(CREATE_GAME_ROUTE)->whereUuid('order');
    Route::post('{order}/store', [Game::class, 'store'])->name(STORE_GAME_ROUTE);
    Route::get('/{game}/play/{referralId}', [Game::class, 'play'])
        ->name(PLAY_GAME_ROUTE)->whereUuid(['game', 'referralId']);
    Route::post('/{game}/finish', [Game::class, 'finish'])->name(FINISH_GAME_ROUTE)->whereUuid('game');
});

// Campaign
Route::prefix('campaigns')->middleware('auth')->group(function () {
    Route::post('/', [Campaign::class, 'store'])->name(CREATE_CAMPAIGN_ROUTE);
    Route::get('/{id}/games/{gameId}/generate-link', [Campaign::class, 'generateLink'])
        ->name(GENERATE_LINK_CAMPAIGN_ROUTE)->whereUuid(['id', 'gameId']);
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
    Route::get('/create', [MyGame::class, 'create'])
        ->name(CREATE_GAME_TEMPLATE_ROUTE)->can('create', App\Models\GameTemplate::class);
    Route::post('/store', [MyGame::class, 'store'])->name(STORE_TEMPLATE_GAME_ROUTE);
});

// My Order
Route::prefix('orders')->middleware('auth')->group(function () {
    Route::get('/', [MyOrder::class, 'index'])->name(MY_ORDER_GAME_ROUTE);
    Route::prefix('/{id}')->group(function () {
        Route::get('/', [MyOrder::class, 'show'])->name(SHOW_ORDER_GAME_ROUTE)->whereUuid('id');
        Route::get('/confirms/{action}', [MyOrder::class, 'confirm'])->name(CONFIRM_ORDER_GAME_ROUTE)
            ->whereUuid('id')
            ->where(['action' => ACCEPTED_ORDER_STATUS . '|' . DENIED_ORDER_STATUS]);
        Route::post('/storeGame', [MyOrder::class, 'storeGame'])->name(ORDER_STORE_GAME_ROUTE);
        Route::get('/download-resource', [MyOrder::class, 'downloadResource'])->name(ORDER_DOWNLOAD_RESOURCE_ROUTE);
    });
});

// Transaction
Route::prefix('transactions')->middleware('auth')->group(function () {
    Route::get('/', [Transaction::class, 'index'])->name(MY_TRANSACTION_ROUTE);
});


Route::prefix('l2e')->middleware('auth')->group(function () {
    Route::prefix('courses')->controller(LearningCourse::class)->group(function () {
        Route::get('/my-courses', 'myCourses')->name(MY_COURSE_ROUTE);
        Route::get('/create', 'create')->name(CREATE_COURSE_ROUTE);
        Route::get('/edit/{id}', 'edit')->name(EDIT_COURSE_ROUTE);
        Route::post('/store', 'store')->name(STORE_COURSE_ROUTE);
    });

    Route::controller(LearnToEarn::class)->group(function () {
        Route::get('/', 'index')->name(L2E_ROUTE);
        Route::get('/create', 'create')->name(CREATE_L2E_ROUTE);
        Route::post('/create', 'store')->name(STORE_L2E_ROUTE);
    });

    //Route::get('/course/create', [LearningCourse::class, 'create'])->name(CREATE_L2E_COURSE_ROUTE);
    Route::post('/course/create/step2', [LearningCourse::class, 'create2'])->name(CREATE_STEP2_L2E_COURSE_ROUTE);
});

Route::get('/learn/{game}/play/{referralId}', [Game::class, 'play'])
        ->name(PLAY_LEARN_ROUTE)->whereUuid(['game', 'referralId']);

Route::view('/test-near', 'web.game.test_near_frontend');
