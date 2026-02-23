<?php

namespace App\Modules\Permissions\app\Controllers;

use Route;
use Validator;
use App\Modules\Permissions\app\Models\Group;
use App\Modules\Permissions\app\Models\Permission;
use App\Modules\Permissions\app\Models\GroupPermission;
use App\Modules\Permissions\app\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = Group::get();
        
        return view('permissions::groups.index', ['groups'=>$groups]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $permissions = Permission::visible()->get();
        
        return view('permissions::groups.create', [
            'permissions_list'=>$permissions
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $group_id = null)
    {
        $model_info = Group::where('group_id', $group_id)->first();
        $permissions = Permission::visible()->get();
        
        return view('permissions::groups.edit', [
            'model_info'=>$model_info,
            'permissions_list'=>$permissions
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules is set of validation rules
        $rules = [
        	'name' => 'required',
        	'description' => 'required',
        ];

        // validate request data before continue
        $validator = Validator::make($request->all(), $rules);

        // if request data is valid it continue 
        // if is invalid return back with errors
        if ($validator->fails()) { 
            if($request->ajax()) {
                return ['errors' => $validator->errors()];
            }

            return redirect()->back()->withErrors($validator)->withInput();
        } 

        $model = Group::create([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);

        if($model && is_array($request->permissions)) {
            foreach ($request->permissions as $key => $value) {
                GroupPermission::create([
                    'group_id' => $model->group_id,
                    'permission_id' => $value
                ]);
            }
        }

        return redirect('permissions/groups/edit/'.$model->group_id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $group_id = null)
    {
        $model = Group::where('group_id', $group_id)->first();
        $model->update([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);

        if($model && is_array($request->permissions)) {
            GroupPermission::where('group_id', $group_id)->delete();

            foreach ($request->permissions as $key => $value) {
                GroupPermission::create([
                    'group_id' => $group_id,
                    'permission_id' => $value
                ]);
            }
        }

        return redirect('permissions/groups/edit/'.$group_id);
    }
}
