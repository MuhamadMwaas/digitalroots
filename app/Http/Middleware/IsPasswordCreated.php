<?php

namespace App\Http\Middleware;

use App\Http\Traits\SocialHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsPasswordCreated
{
    use SocialHelper;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$this->haspassword(Auth::user()->social_type, Auth::user()->password)) {
            return redirect()->route('new_password.view');
        }
        return $next($request);
    }
}
