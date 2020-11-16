<?php

namespace App\Providers;

use App\Http\Controllers\PostTagsSync;
use App\Services\WeatherMapApi;
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

        view()->composer('layout.sidebar', function (View $view, WeatherMapApi $weatherMapApi) {
            $view->with('weatherData', $weatherMapApi->getWeather());
        });

        $this->app->bind(PostTagsSync::class, function ($app) {
            return new PostTagsSync();
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
