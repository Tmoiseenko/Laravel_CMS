<?php

namespace App\Providers;

use App\Http\Controllers\PostTagsSyncController;
use App\Services\WeatherMapApi;
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
            $view->with('weatherData', app(WeatherMapApiServiceProvider::class)->getWeather()
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
