<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\User;

use Helper;
use Validator;
use App\Models\User;
use App\Models\Post;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\SupportFacades\Log;

class StoreHandler
{
    /**
     * Store a newly created Users in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $rules is set of validation rules
        $rules = [
        	'first_name' => 'required',
        	'second_name' => 'required',
        	'last_name' => 'required',
        	'username' => 'required',
        	'social_name' => 'required',
        	'social_id' => 'required',
        	'email' => 'required|string|email|max:255|unique:users,email',
        	'phone' => 'required',
        	'password' => 'required|string|min:8|confirmed',
        	'role' => 'required',
        	'email_verified_at' => 'required',
        ];

        // validate request data before continue
        $validator = Validator::make($request->all(), $rules);

        // if request data is valid it continue 
        // if is invalid return back with errors
        if ($validator->fails()) { 
            if($request->ajax() || $api) {
                return response()->json(['errors' => $validator->errors()]);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        } 
        $save_uploaded_profile_url = Helper::save_uploaded_file($request, 'profile_url');
        
        // $body is the array of data to be save to users table 
        $body = [
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'social_name' => $request->social_name,
            'social_id' => $request->social_id,
            'email' => $request->email,
            'phone' => $request->phone,
        	'password' => bcrypt($request->password),
            'role' => $request->role,
        	'profile_url' => $save_uploaded_profile_url,
        	'token' => ($request->token)? $request->token: "",
        	'remember_token' => ($request->remember_token)? $request->remember_token: "",
        	'status' => ($request->status)? $request->status: 1,
            'created_at' => $current_time,
            'updated_at' => $current_time,
            'deleted_at' => $request->deleted_at,
            'email_verified_at' => $request->email_verified_at,
        ];

        // saving the $body data to users table
        $model = User::create($body);
        if($model) {
            if(is_array($request->user_logs_list)) {
                foreach($request->user_logs_list as $index => $item) {
                    UserLog::create([
                        'account_id' => $item['account_id'],
                        'user_id' => $model->user_id,
                        'log_id' => $item['log_id'],
                        'datail' => $item['datail'],
                        'timestamp' => $current_time,
                    ]);
                }
            }
        }

        if($request->ajax() || $api) {
            $users_default = [ 
                ['key'=>'', 'value'=>'Select users'], 
                ['key'=>'<new>', 'value'=>'Create new users'], 
            ];
            $users_new = User::orderBy('first_name', 'ASC')->get(['user_id as key','first_name as value'])->toArray();
            $options_list = (array) array_merge($users_default, $users_new);
                
            return response()->json([
                "status"=>"success",
                "options_list"=> $options_list,
                "selected_id"=>$model->user_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Users data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/manage-users/users/edit/'.$model->user_id)->with(['alert-success'=>'Users data saved']);
    }
}