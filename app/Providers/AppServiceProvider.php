<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use ProtoneMedia\Splade\Facades\Splade;
use TomatoPHP\TomatoAdmin\Facade\TomatoMenu;
use TomatoPHP\TomatoSaas\TenancyServiceProvider;

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
            __('Ordering') => "bx bxs-receipt",
            __('Invoices') => "bx bxs-group",
            __('Notifications') => "bx bxs-notification",
            __('Wallets') => "bx bxs-wallet-alt",
            __('Themes') => "bx bxs-pen",
            __('Support Center') => "bx bx-support",
            trans('tomato-roles::global.menu.group') => "bx bxs-lock-alt",
            __('Locations') => "bx bxs-map",
            trans('tomato-forms::global.form.group') => "bx bxs-map",
            __('Tools') => "bx bxs-wrench",
            __('Eddy') => "bx bxs-data",
            __('Settings') => "bx bxs-cog",
        ]);
    }
}
