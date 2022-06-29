<?php

namespace App\Providers;

use App\Interfaces\IntToStringInterface;
use App\Services\NumberConvertor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IntToStringInterface::class, NumberConvertor::class);
        $this->app->bind(NumberConvertor::class, function ($app) {
            return new NumberConvertor($app['config']['services.number_convertor.number_words']);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
