<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\UserLog;

use Helper;
use Validator;
use App\Models\UserLog;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;

class UpdateHandler
{
    /**
     * Update the specified User Logs in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $user_log_id = null, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = UserLog::where('user_log_id', $user_log_id)->first();

        // initialize $body: data that need to be updated
        $body = [];
        if(isset($inputs->user_log_id)) $body['user_log_id'] = $inputs->user_log_id; // check if field 'user_log_id' exist from the request and then add it to $body
        if(isset($inputs->account_id)) $body['account_id'] = $inputs->account_id; // check if field 'account_id' exist from the request and then add it to $body
        if(isset($inputs->user_id)) $body['user_id'] = $inputs->user_id; // check if field 'user_id' exist from the request and then add it to $body
        if(isset($inputs->log_id)) $body['log_id'] = $inputs->log_id; // check if field 'log_id' exist from the request and then add it to $body
        if(isset($inputs->datail)) $body['datail'] = $inputs->datail; // check if field 'datail' exist from the request and then add it to $body
        if(isset($inputs->timestamp)) $body['timestamp'] = $inputs->timestamp; // check if field 'timestamp' exist from the request and then add it to $body
        
        // if there is data to update then update
        if(count($body)){
            // update user_logs table
            $model->update($body);
        }

        if($request->ajax() || $api) {
            $user_logs_default = [ 
                ['id'=>'', 'name'=>'Select user logs'], 
                ['id'=>'<new>', 'name'=>'Create new user logs'], 
            ];
            $user_logs_new = UserLog::orderBy('id', 'ASC')->get(['user_log_id as id','id as name'])->toArray();
            $user_logs_list = (array) array_merge($user_logs_default, $user_logs_new);
                
            return response()->json([
                "status"=>"success",
                "user_logs_list"=> $user_logs_list,
                "selected_id"=>$model->user_log_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'User Logs data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'User Logs data updated']);
    }
}