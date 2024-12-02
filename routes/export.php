<?php

use Illuminate\Support\Facades\Route;
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
