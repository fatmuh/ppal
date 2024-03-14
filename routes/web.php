<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KtaController;
use App\Http\Controllers\LandingController;
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

Route::controller(LandingController::class)->name('landing.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
});

Route::controller(AuthController::class)->middleware('guest')->name('auth.')->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('authentication', 'authentication')->name('authentication');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::controller(KtaController::class)->prefix('kta')->name('kta.')->group(function () {
        Route::get('/admin', 'list')->name('list');
        Route::get('/admin/tabulator', 'tabulator')->name('tabulator');
        Route::post('/admin/store', 'store')->name('store');
        Route::patch('/admin/update/{id}', 'update')->name('update');
        Route::get('/admin/detail/{id}', 'detail')->name('detail');
        Route::get('/admin/detail/card/front/{id}', 'front')->name('front');
        Route::get('/admin/detail/card/back/{id}', 'back')->name('back');
    });

    Route::controller(PageController::class)->group(function () {
        Route::get('/admin', 'dashboard')->name('dashboard');
    });
});
