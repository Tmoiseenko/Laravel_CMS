<?php

namespace App\Providers;

use App\Http\Controllers\PostTagsSyncController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('layout.sidebar', function (View $view) {
            $view->with('tagsCloud', \App\Tag::tagsCloud());
        });

        view()->composer('layout.sidebar', function (View $view) {
            $view->with('weatherData', \App\WeatherMapApi::getWeather(
                                            config('skillbox.ipfy'),
                                            config('skillbox.geoip'),
                                            config('skillbox.yandex_whether.url'),
                                            config('skillbox.yandex_whether.api_key')
                                        )
            );
        });

        $this->app->bind(PostTagsSyncController::class, function ($app) {
            return new PostTagsSyncController();
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
