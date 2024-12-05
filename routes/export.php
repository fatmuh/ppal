<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KtaController;
use App\Http\Controllers\ImportExportController;

/*
|--------------------------------------------------------------------------
| Export
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(ImportExportController::class)->group(function () {
    Route::get('/admin/kta/export', 'export')->name('kta.export');
    Route::get('/admin/kta/export/csv', 'exportImport')->name('kta.export.csv');
});

Route::controller(KtaController::class)->prefix('kta')->name('kta.')->group(function () {
    Route::get('/detail/card/front/{id}', 'front')->name('front');
    Route::get('/detail/card/back/{id}', 'back')->name('back');
});

Route::controller(ImageController::class)->group(function () {
    Route::get('/get-image', 'getImage')->name('kta.get.image');
});
