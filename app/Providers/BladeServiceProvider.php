<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
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
        Blade::directive('role', function ($role) {
            return "<?php if(auth()->check() && auth()->user()->hasRole({$role})): ?>";
        });
        Blade::directive('elserole', function ($role) {
            return "<?php else: ?>";
        });
        Blade::directive('endrole', function ($role) {
            return "<?php endif; ?>";
        });
        Blade::directive('linkactive', function ($route) {
            return "<?php echo request()->routeIs($route) ? 'active disabled' : null; ?>";
        });
    }
}
