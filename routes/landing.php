<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

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
