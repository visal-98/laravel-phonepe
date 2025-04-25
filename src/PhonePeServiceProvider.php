<?php

namespace Visal\PhonePe;

use Visal\PhonePe\PhonePe;
use Illuminate\Support\ServiceProvider;

class PhonePeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/phonepe.php', 'phonepe');

        $this->app->singleton('phonepe', function () {
            return new PhonePe();
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/phonepe.php' => config_path('phonepe.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views', 'phonepe');
    }
}
