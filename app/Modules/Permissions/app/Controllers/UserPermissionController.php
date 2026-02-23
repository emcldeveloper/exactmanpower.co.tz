<?php

namespace App\Modules\Permissions\app\Controllers;

use User;
use Route;
use App\Modules\Permissions\app\Models\Role;
use App\Modules\Permissions\app\Models\Permission;
use App\Modules\Permissions\app\Models\RolePermission;
use App\Modules\Permissions\app\Models\UserPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = [];
        $users_list = User::manager()->paginate();
        $user = user();
        $data['users_list'] = $users_list;
        
        return view('permissions::user-group.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assign(Request $request, $user_id = null)
    {
        $data = [];
        $model_info = User::where('user_id', $user_id)->first();
        $groups_list = Role::get();
        $permissions_list = Permission::visible()->get();
        $group_permissions_list = RolePermission::get();

        $data['model_info'] = $model_info;
        $data['groups_list'] = $groups_list;
        $data['permissions_list'] = $permissions_list;
        $data['group_permissions_list'] = $group_permissions_list;
        
        return view('permissions::user-group.create', $data);
    }

    public function assign_store(Request $request, $user_id = null) 
    {
        // dd($request->all());
        if($request->sys_role_id) {
            $model = UserPermission::where('user_id', $user_id)
                ->where('sys_role_id', $request->sys_role_id)
                ->first();

            if(!$model) {
                UserPermission::create([
                    'user_id' => $user_id,
                    'sys_role_id' => $request->sys_role_id,
                    'sys_permission_id' => null,
                ]);
            }
        }

        if(is_array($request->permissions)) {
            foreach($request->permissions as $index => $value) {
                $model = UserPermission::where('user_id', $user_id)
                    ->where('sys_permission_id', $value)
                    ->first();

                if(!$model) {
                    UserPermission::create([
                        'user_id' => $user_id,
                        'sys_role_id' => null,
                        'sys_permission_id' => $value,
                    ]);
                }
            }
        }

        return redirect()->back();
    }

}
