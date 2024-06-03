<?php

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

Route::middleware(['splade'])->group(function () {
    if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === config('tenancy.central_domains.0')) {
        Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/demo', [\App\Http\Controllers\HomeController::class, 'demo'])->name('home.demo');
        Route::post('/demo', [\App\Http\Controllers\HomeController::class, 'store'])->name('home.demo.store');
        Route::post('/report', [\App\Http\Controllers\HomeController::class, 'report'])->name('home.report');
    }

    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();
});
