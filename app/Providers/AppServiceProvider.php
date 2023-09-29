<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;

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
           ->icon('bx bx-group')
           ->route('admin.customers.index')
       ]);
    }
}
