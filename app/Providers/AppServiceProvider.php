<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use Jenssegers\Date\Date as Date;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Date::setLocale('id');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
