<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Spatie\LaravelSettings\Models\SettingsProperty;
use Spatie\LaravelSettings\Settings;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Stancl\Tenancy\Events\DatabaseCreated;
use Stancl\Tenancy\Events\DatabaseSeeded;
use Stancl\Tenancy\Events\SyncedResourceChangedInForeignDatabase;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoAdmin\Services\Contracts\Menu;
use TomatoPHP\TomatoRoles\Services\TomatoRoles;
use TomatoPHP\TomatoSaas\TenancyServiceProvider;
use TomatoPHP\TomatoSettings\Models\Setting;
use TomatoPHP\TomatoTranslations\Models\Translation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(TenancyServiceProvider::class);
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
    }
}
