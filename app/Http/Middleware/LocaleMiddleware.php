<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LocaleMiddleware
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
        $locale = session('current_locale', 'eng');
        session(['current_locale'=> $locale]);

        App::setLocale($locale);
        //dd($request);
        //return null;
        return $next($request);
    }
}
