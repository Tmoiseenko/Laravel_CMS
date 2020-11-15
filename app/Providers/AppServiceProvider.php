<?php

namespace App\Providers;

use App\Http\Controllers\PostTagsSyncController;
use Illuminate\Support\Facades\App;
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
            $view->with('weatherData', App::make('WeatherMapApi')->getWeather());
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
