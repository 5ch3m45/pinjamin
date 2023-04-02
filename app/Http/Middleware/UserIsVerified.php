<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check() && auth()->user()->is_verified == 0) {
            return abort(404);
        }
        return $next($request);
    }
}
