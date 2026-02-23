<?php

namespace App\Http\Middleware;

use User;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SelfRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!user()->is_admin){
            return new Response(view('error.403')->with('role', 'ADMIN'));
        }

        return $next($request);
    }
}
