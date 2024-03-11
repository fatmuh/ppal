<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KtaController;
use App\Http\Controllers\PageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->middleware('guest')->name('auth.')->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('authentication', 'authentication')->name('authentication');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::controller(KtaController::class)->prefix('kta')->name('kta.')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::get('/tabulator', 'tabulator')->name('tabulator');
        Route::post('/store', 'store')->name('store');
        Route::patch('/update/{id}', 'update')->name('update');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::get('/detail/card/front/{id}', 'front')->name('front');
        Route::get('/detail/card/back/{id}', 'back')->name('back');
    });

    Route::controller(PageController::class)->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
    });
});
