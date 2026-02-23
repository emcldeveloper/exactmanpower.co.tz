<?php

namespace App\Modules\Permissions\app\Middleware;

use User;
use Auth;
use Closure;
use Route;
use Illuminate\Http\Response;

use App\Modules\Permissions\app\Models\Group;
use App\Modules\Permissions\app\Models\Permission;
use App\Modules\Permissions\app\Models\GroupPermission;
use App\Modules\Permissions\app\Models\UserGroup;

class PermissionsMiddleware
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

        if(!$user->is_admin) {
            $groups_ids = UserGroup::where('user_id', user('user_id'))->get()
                ->pluck('group_id')
                ->toArray();

            $permissions_ids_a = UserGroup::where('user_id', user('user_id'))->get()
                ->pluck('permission_id')
                ->toArray();

            $permissions_ids_b =  GroupPermission::whereIn('group_id', $groups_ids)->get()
                ->pluck('permission_id')
                ->toArray();

            $permissions_ids = array_merge($permissions_ids_a, $permissions_ids_b);
            $permissions = Permission::whereIn('permission_id', $permissions_ids)->get()
                ->pluck('name')
                ->toArray();

            if (!in_array(Route::current()->uri, $permissions)) {
                return new Response(view('error.403')->with('role', 'Authorized users only'));
            }
        }

        return $next($request);
    }
}
