<?php
/**
 * @category Method handler
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

class UpdateHandler
{
    /**
     * Update the specified Users in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $user_id = null, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = User::where('user_id', $user_id)->first();

        // initialize $body: data that need to be updated
        $body = [];
        if(isset($inputs->user_id)) $body['user_id'] = $inputs->user_id; // check if field 'user_id' exist from the request and then add it to $body
        if(isset($inputs->first_name)) $body['first_name'] = $inputs->first_name; // check if field 'first_name' exist from the request and then add it to $body
        if(isset($inputs->second_name)) $body['second_name'] = $inputs->second_name; // check if field 'second_name' exist from the request and then add it to $body
        if(isset($inputs->last_name)) $body['last_name'] = $inputs->last_name; // check if field 'last_name' exist from the request and then add it to $body
        if(isset($inputs->username)) $body['username'] = $inputs->username; // check if field 'username' exist from the request and then add it to $body
        if(isset($inputs->social_name)) $body['social_name'] = $inputs->social_name; // check if field 'social_name' exist from the request and then add it to $body
        if(isset($inputs->social_id)) $body['social_id'] = $inputs->social_id; // check if field 'social_id' exist from the request and then add it to $body
        if(isset($inputs->email)) $body['email'] = $inputs->email; // check if field 'email' exist from the request and then add it to $body
        if(isset($inputs->phone)) $body['phone'] = $inputs->phone; // check if field 'phone' exist from the request and then add it to $body
        if(isset($inputs->password)) $body['password'] = $inputs->password; // check if field 'password' exist from the request and then add it to $body
        if(isset($inputs->role)) $body['role'] = $inputs->role; // check if field 'role' exist from the request and then add it to $body
        $uploaded_profile_url = Helper::save_uploaded_file($request, 'profile_url');
        if(isset($uploaded_profile_url) && $uploaded_profile_url) $body['profile_url'] = $uploaded_profile_url; // check if field 'profile_url' exist from the request and then add it to $body
        if(isset($inputs->token)) $body['token'] = $inputs->token; // check if field 'token' exist from the request and then add it to $body
        if(isset($inputs->remember_token)) $body['remember_token'] = $inputs->remember_token; // check if field 'remember_token' exist from the request and then add it to $body
        if(isset($inputs->status)) $body['status'] = ($inputs->status)? $inputs->status: 0; // check if field 'status' exist from the request and then add it to $body
        if(isset($inputs->created_at)) $body['created_at'] = $inputs->created_at; // check if field 'created_at' exist from the request and then add it to $body
        $body['updated_at'] =  $current_time; // check if field 'updated_at' exist from the request and then add it to $body
        if(isset($inputs->deleted_at)) $body['deleted_at'] = $inputs->deleted_at; // check if field 'deleted_at' exist from the request and then add it to $body
        if(isset($inputs->email_verified_at)) $body['email_verified_at'] = $inputs->email_verified_at; // check if field 'email_verified_at' exist from the request and then add it to $body
        
        // if there is data to update then update
        if(count($body)){
            // update users table
            $model->update($body);
        }
        if(is_array($request->user_logs_list)) {
            $updated_ids = [];
            $old_ids = UserLog::where('user_id', $model->user_id)->pluck('user_log_id')->toArray();
            foreach($request->user_logs_list as $index => $item) {
                $sub_body = [
                    'account_id' => $item['account_id'],
                    'user_id' => $model->user_id,
                    'log_id' => $item['log_id'],
                    'datail' => $item['datail'],
                    'timestamp' => $current_time,
                ];

                if(isset($item['user_log_id']) && in_array($item['user_log_id'], $old_ids)) {
                    $updated_ids[] = $item['user_log_id'];
                    UserLog::where('user_log_id', $item['user_log_id'])->update($sub_body);
                } else {
                    UserLog::create($sub_body);
                }
            }

            foreach ($old_ids as $value) {
                if(!in_array($value, $updated_ids)){
                    UserLog::where('user_log_id', $value)->delete();
                }
            }
        }

        if($request->ajax() || $api) {
            $users_default = [ 
                ['id'=>'', 'name'=>'Select users'], 
                ['id'=>'<new>', 'name'=>'Create new users'], 
            ];
            $users_new = User::orderBy('first_name', 'ASC')->get(['user_id as id','first_name as name'])->toArray();
            $users_list = (array) array_merge($users_default, $users_new);
                
            return response()->json([
                "status"=>"success",
                "users_list"=> $users_list,
                "selected_id"=>$model->user_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Users data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Users data updated']);
    }
}