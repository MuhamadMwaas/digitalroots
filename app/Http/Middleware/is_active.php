<?php

namespace App\Http\Middleware;

use App\Models\UserActive;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class is_active
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (!Auth::user()->is_active) {
                Auth::logout();
                return redirect()->route('Login.view')->with('error', 'your account not active');
            }

            if (UserActive::where('user_id', '=', Auth::guard('web')->user()->id)->first()) {
                $userActive = UserActive::where('user_id', '=', Auth::guard('web')->user()->id)->first();
                $userActive->lastseen = now();
                $userActive->save();
            } else {
                UserActive::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'lastseen' => now()
                ]);
            }
        }
        return $next($request);
    }
}
