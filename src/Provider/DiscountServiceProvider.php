<?php

namespace Abolfazlrastegar\LaravelDiscount\Provider;

use Abolfazlrastegar\LaravelDiscount\components\CreateDiscount;
use Abolfazlrastegar\LaravelDiscount\DiscountController;
use Hekmatinasser\Verta\Laravel\VertaServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{
    public function register()
    {
//        $this->app->singleton('discount', function ($app) {
//                return new DiscountController();
//        });
    }

    public function boot()
    {
        $this->registerMigration();
        $this->registerConfig();
        $this->registerView();
        $this->registerPublic();
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewComponentsAs('Discount', [CreateDiscount::class]);

        Paginator::defaultView('discount::pagination');
        Paginator::defaultSimpleView('discount::pagination');
    }


    protected function registerView () {
        $this->loadViewsFrom(__DIR__ . '../views', 'discount');
        $this->publishes([
            realpath(__DIR__ . '/../views') => base_path('resources/views/vendor/discount')
        ], 'views');
    }


    protected function registerPublic () {
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/discount'),
        ], 'public');
    }

    protected function registerConfig () {
        $this->publishes([
            realpath(__DIR__ . '/../config/discount.php') =>  config_path('discount.php')
        ], 'config');
    }

    protected function registerMigration () {
        $this->loadMigrationsFrom(__DIR__ . '/../Migrations');
        $this->publishes([
            realpath(__DIR__ . '/../Migrations') => database_path('migrations'),
        ], 'migrations');
    }

}
