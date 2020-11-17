<?php

namespace App\Providers;

use App\Services\WeatherMapApi;
use Illuminate\Support\ServiceProvider;

class WeatherMapApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('WeatherMapApi', function () {
            return new WeatherMapApi(
                config('skillbox.ipfy'),
                config('skillbox.geoip'),
                config('skillbox.yandex_whether.url'),
                config('skillbox.yandex_whether.api_key')
            );
        });
    }
}
