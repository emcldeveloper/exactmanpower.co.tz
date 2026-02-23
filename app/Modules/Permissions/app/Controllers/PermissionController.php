<?php

namespace App\Modules\Permissions\app\Controllers;

use Route;
use App\Modules\Permissions\app\Models\Group;
use App\Modules\Permissions\app\Models\Permission;
use App\Modules\Permissions\app\Models\GroupPermission;
use App\Modules\Permissions\app\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::get();
        $permissions_array = $permissions->pluck('name')->toArray();
        $route_collection = Route::getRoutes();
        foreach ($route_collection as $row) {
            $url = $row->uri;
            $is_visible = (strpos($url, 'admin/') === 0)? true: 
                ((strpos($url, 'permissions/') === 0)? true: false);

            $method = $row->methods[0];
            $title = ucfirst(trim(str_replace(['/{', '/'], [' by /{', ' '], $url)));

            if(!in_array($url, $permissions_array)) {
                Permission::create([
                    'name' => $url,
                    'description' => $title,
                    'is_visible' => $is_visible,
                ]);
            } else {
                // Permission::where('name', $url)->update([
                //     'description'=>$title,
                //     'is_visible' => $is_visible
                // ]);
            }
        }

        $permissions = Permission::visible()->get();
        
        return view('permissions::permissions.index', ['permissions'=>$permissions]);
    }


}
