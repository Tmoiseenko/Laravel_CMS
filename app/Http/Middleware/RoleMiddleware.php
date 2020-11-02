<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(!auth()->check()) {
            return redirect('login');
        }
        if(!auth()->user()->hasRole($role)) {
            flash("У вас не доставточно прав для входа в административный раздел", 'danger');
            return redirect()->route('home');
        }
        return $next($request);
    }
}
