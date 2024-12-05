<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ImportExportController;
use App\Http\Controllers\KtaController;
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

Route::controller(ImageController::class)->group(function () {
    Route::get('/get-image', 'getImage')->name('kta.get.image');
});
