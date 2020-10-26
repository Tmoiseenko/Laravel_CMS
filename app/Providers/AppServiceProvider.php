<?php

namespace App\Providers;

use App\Http\Controllers\PostTagsSyncController;
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

        $this->app->bind('HelpSpot\API', function ($app) {
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
