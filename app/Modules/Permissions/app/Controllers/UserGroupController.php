<?php

namespace App\Modules\Permissions\app\Controllers;

use User;
use Route;
use App\Modules\Permissions\app\Models\Group;
use App\Modules\Permissions\app\Models\Permission;
use App\Modules\Permissions\app\Models\GroupPermission;
use App\Modules\Permissions\app\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserGroupController extends Controller
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
        $groups_list = Group::get();
        $permissions_list = Permission::visible()->get();
        $group_permissions_list = GroupPermission::get();

        $data['model_info'] = $model_info;
        $data['groups_list'] = $groups_list;
        $data['permissions_list'] = $permissions_list;
        $data['group_permissions_list'] = $group_permissions_list;
        
        return view('permissions::user-group.create', $data);
    }

    public function assign_store(Request $request, $user_id = null) 
    {
        // dd($request->all());
        if($request->group_id) {
            $model = UserGroup::where('user_id', $user_id)
                ->where('group_id', $request->group_id)
                ->first();

            if(!$model) {
                UserGroup::create([
                    'user_id' => $user_id,
                    'group_id' => $request->group_id,
                    'permission_id' => null,
                ]);
            }
        }

        if(is_array($request->permissions)) {
            foreach($request->permissions as $index => $value) {
                $model = UserGroup::where('user_id', $user_id)
                    ->where('permission_id', $value)
                    ->first();

                if(!$model) {
                    UserGroup::create([
                        'user_id' => $user_id,
                        'group_id' => null,
                        'permission_id' => $value,
                    ]);
                }
            }
        }

        return redirect()->back();
    }

}
