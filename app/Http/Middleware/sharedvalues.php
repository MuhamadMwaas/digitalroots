<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class sharedvalues
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $admin = User::find(Auth::user()->id);


            $route = Route::currentRouteName();
            $prefix = Route::current()->getPrefix();
            view()->share('route', $route);
            view()->share('admin', $admin);
            view()->share('prefix', $prefix);
        }
        return $next($request);
    }
}
