<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;
use TomatoPHP\TomatoSaas\Models\CentralUser;
use TomatoPHP\TomatoSaas\Models\Tenant;

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


Route::middleware(['auth', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/customers', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
    Route::get('admin/customers/api', [App\Http\Controllers\Admin\CustomerController::class, 'api'])->name('customers.api');
    Route::get('admin/customers/create', [App\Http\Controllers\Admin\CustomerController::class, 'create'])->name('customers.create');
    Route::post('admin/customers', [App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customers.store');
    Route::get('admin/customers/{model}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customers.show');
    Route::get('admin/customers/{model}/edit', [App\Http\Controllers\Admin\CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('admin/customers/{model}', [App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('customers.update');
    Route::delete('admin/customers/{model}', [App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('customers.destroy');
});
