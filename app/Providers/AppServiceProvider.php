<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use TomatoPHP\TomatoRoles\Services\TomatoRoles;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       TomatoMenu::register([
          Menu::make()
               ->label(__('Customers'))
               ->icon('bx bxs-group')
               ->route('admin.customers.index')
       ]);

        Role::creating(function ($role) {
            return false;
        });

       Role::updating(function ($role) {
           return false;
       });

       Role::deleting(function ($role) {
           $permissions = \Spatie\Permission\Models\Permission::all();
           $role = \Spatie\Permission\Models\Role::find(1);
           foreach ($permissions as $permission){
               $role->givePermissionTo($permission);
           }
           return false;
       });
    }
}
