<?php

/**
 * Провайдер приложения
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(\App\Repositories\WeatherRepository::class, function ($app) {
            return new \App\Repositories\WeatherRepository(
                config('services.openweather.key'),
                new \GuzzleHttp\Client(['base_uri' => 'https://api.openweathermap.org'])
            );
        });
    }

    public function boot(): void
    {

    }
}
