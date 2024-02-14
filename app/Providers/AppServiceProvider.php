<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Facades\Splade;
use Spatie\LaravelSettings\Models\SettingsProperty;
use Spatie\LaravelSettings\Settings;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Stancl\Tenancy\Controllers\TenantAssetsController;
use Stancl\Tenancy\Events\DatabaseCreated;
use Stancl\Tenancy\Events\DatabaseSeeded;
use Stancl\Tenancy\Events\SyncedResourceChangedInForeignDatabase;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;
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
              ->group(__('DEMO CRUD'))
               ->label(__('DEMO CRUD'))
               ->icon('bx bxs-invader')
               ->route('admin.customers.index')
       ]);

       Splade::defaultModalCloseExplicitly(true);

       TomatoMenu::groups([
           __('DEMO CRUD') => "bx bxs-invader",
           __('CRM') => "bx bxs-group",
           __('PMS') => "bx bx-task",
           __('Branches') => "bx bxs-building-house",
           __('Category') => "bx bxs-tag",
           __('Forms') => "bx bxs-group",
           __('CMS') => "bx bxs-pencil",
           __('Products') => "bx bxs-group",
           __('Inventory') => "bx bxs-widget",
           __('Offers') => "bx bxs-offer",
           __('Orders') => "bx bxs-group",
           __('Invoices') => "bx bxs-group",
           __('Notifications') => "bx bxs-notification",
           __('Wallets') => "bx bxs-wallet-alt",
           __('Themes') => "bx bxs-pen",
           __('Support Center') => "bx bx-support",
           __('ALC') => "bx bxs-lock-alt",
           __('Locations') => "bx bxs-map",
           __('Tools') => "bx bxs-wrench",
           __('Eddy') => "bx bxs-data",
           __('Settings') => "bx bxs-cog",
       ]);


    }
}
