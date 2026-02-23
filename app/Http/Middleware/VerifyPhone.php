<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Session;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class VerifyPhone
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
        if (Auth::check() && is_null(user('phone_verified_at'))) {
            // Session::put('url.intended', URL::full());
            // return redirect('phone/verify');
        }

        return $next($request);
    }
}
