<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if(Auth::check() && Auth::user()->role == 0) {
        //     return $next($request);  
        // }
        return $request->expectsJson() ? null : route('homepage');

        // if (! $request->expectsJson() && Auth::user()->role == 1) {
        //     dd('ok');
        //     // return route('login');
        //     return route('homepage');
        // } else {
        //     return route('homepage');
        // }
    }
}
