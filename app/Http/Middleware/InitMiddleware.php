<?php

namespace App\Http\Middleware;

use Config;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class InitMiddleware
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
        $hostname = $request->getHttpHost();
        $local_inv = ['localhost','project.co'];
        $dev_inv = ['dev.sematanzania.org','dev-malezi.sematanzania.org'];

        if(in_array($hostname, $local_inv)) {
            $inv = config('backend.urls-local');
            $inv['malezi'] = url('malezi');
            Config::set('backend.urls', $inv);
        } elseif(in_array($hostname, $dev_inv)) {
            $inv = config('backend.urls-dev');
            Config::set('backend.urls-dev', $inv);
        }

        return $next($request);
    }
}
