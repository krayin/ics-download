<?php

namespace Webkul\CalendarApp\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class CalendarAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->app->register(EventServiceProvider::class);

        $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'calendarapp');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'calendarapp');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }
}