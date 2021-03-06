<?php

namespace Abolfazlrastegar\LaravelDiscount\Provider;

use Abolfazlrastegar\LaravelDiscount\Components\CreateDiscount;
use Abolfazlrastegar\LaravelDiscount\DiscountController;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('discount', function ($app) {
            return new DiscountController();
        });

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Discount', "Abolfazlrastegar\LaravelDiscount\Facades\Discount");

        $this->registerRoutes();
    }

    public function boot()
    {
        $this->registerMigrations();
        $this->registerConfigs();
        $this->registerViews();
        $this->registerPublics();
        $this->loadViewComponentsAs('Discount', [CreateDiscount::class]);

        Paginator::defaultView('discount::pagination');
        Paginator::defaultSimpleView('discount::pagination');
    }

    protected function registerRoutes () {
        Route::group(['middleware' => config('discount.middleware'), 'prefix' => config('discount.prefix')], function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });
    }

    protected function registerViews () {
        $this->loadViewsFrom(__DIR__ . '../views', 'discount');
        $this->publishes([
            realpath(__DIR__ . '/../views') => base_path('resources/views/vendor/discount')
        ], 'views');
    }


    protected function registerPublics () {
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/discount'),
        ], 'public');
    }

    protected function registerConfigs () {
        $this->publishes([
            realpath(__DIR__ . '/../config/discount.php') =>  config_path('discount.php')
        ], 'config');
    }

    protected function registerMigrations () {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->publishes([
            realpath(__DIR__ . '/../Migrations') => database_path('migrations'),
        ], 'migrations');
    }

}
