<?php

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
        Route::get('/', fn () => view('welcome'))->name('home');
        Route::get('/demo', function (){
            return view('demo');
        })->name('home.demo');
        Route::post('/demo', function (\TomatoPHP\TomatoSaas\Http\Requests\Sync\SyncStoreRequest $request){
            $request->validated([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:255',
                'username' => [
                    'required',
                    'regex:/^[a-zA-Z]*$/',
                    'min:3',
                    Rule::unique('syncs', 'username')
                ],
                'password' => 'required|min:6|confirmed|string|max:255',
                'store' => 'required|string|max:255',
            ]);

            $sync = new CentralUser();
            $sync->global_id = $request->get('username');
            $sync->first_name = $request->get('first_name');
            $sync->last_name = $request->get('last_name');
            $sync->password = bcrypt($request->get('password'));
            $sync->email = $request->get('email');
            $sync->phone = $request->get('phone');
            $sync->type = $request->get('type');
            $sync->plan = $request->get('plan');
            $sync->user_id = auth('web')->user()->id;
            $sync->username = Str::lower($request->get('username'));
            $sync->store = $request->get('store');
            $sync->apps = [];
            $sync->save();

            $saas = Tenant::create([
                'id' => $request->get('username')
            ]);

            $saas->domains()->create([
                'domain' => $request->get('username') .'.'. config('tenancy.central_domains.0')
            ]);

            $sync->tenants()->attach($saas);
            $token = tenancy()->impersonate($saas, 1, '/admin', 'web');

            Toast::title(__('Your Domain Has Been Created'))->success()->autoDismiss(5);
            return redirect()->to('https://'.$saas->domains[0]->domain . '/admin/login/url?token='.$token->token .'&email='. $sync->email);
        })->name('home.demo.store');
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
