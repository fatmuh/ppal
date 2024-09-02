<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\KtaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;

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
    Route::get('/search', 'search')->name('search');
    Route::post('/search', 'searchData')->name('search.data');
    Route::get('/detail', 'detail')->name('detail');
    Route::post('/store', 'store')->name('store');
    Route::patch('/update/{id}', 'update')->name('update');
});

Route::controller(KtaController::class)->prefix('kta')->name('kta.')->group(function () {
    Route::get('/detail/card/front/{id}', 'front')->name('front');
    Route::get('/detail/card/back/{id}', 'back')->name('back');
});

Route::controller(AuthController::class)->middleware('guest')->name('auth.')->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('authentication', 'authentication')->name('authentication');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::controller(KtaController::class)->prefix('admin/kta')->name('kta.')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::get('/tabulator', 'tabulator')->name('tabulator');
        Route::post('/store', 'store')->name('store');
        Route::patch('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::get('/detail-data/{id}', 'detailData')->name('detail.data');
    });

    Route::controller(UserController::class)->prefix('admin/users')->name('user.')->group(function () {
        Route::get('/', 'list')->name('list');
        Route::get('/tabulator', 'tabulator')->name('tabulator');
        Route::post('/store', 'store')->name('store');
        Route::patch('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'delete')->name('delete');
        Route::get('/detail/{id}', 'detail')->name('detail');
    });

    Route::controller(PageController::class)->group(function () {
        Route::get('/admin', 'dashboard')->name('dashboard');
    });

});

Route::controller(ImportExportController::class)->group(function () {
    Route::get('/admin/kta/export', 'export')->name('kta.export');
    Route::get('/admin/kta/export/csv', 'exportImport')->name('kta.export.csv');
});

Route::controller(ImageController::class)->group(function () {
    Route::get('/get-image', 'getImage')->name('kta.get.image');
});
