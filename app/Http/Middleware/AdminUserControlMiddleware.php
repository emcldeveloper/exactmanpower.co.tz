<?php

namespace App\Http\Middleware;

use User;
use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminUserControlMiddleware
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
        $user = user();
        if(session('admin_active_user_id')) {
            return redirect()->back()->with([
                'modal_alert'=>'alert-danger',
                'modal_title'=>'Not Allowed',
                'modal_content'=>'You are not allowed to tamper with user account',
            ]);
        }

        return $next($request);
    }
}
