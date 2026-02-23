<?php
/**
 * @category Application
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

class StoreHandler
{
    /**
     * Store a newly created User Logs in storage.
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
        	'account_id' => 'required',
        	'user_id' => 'required|exists:users,user_id',
        	'log_id' => 'required|exists:logs,log_id',
        	'datail' => 'required',
        	'timestamp' => 'required',
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
        
        // $body is the array of data to be save to user_logs table 
        $body = [
            'account_id' => $request->account_id,
            'user_id' => $request->user_id,
            'log_id' => $request->log_id,
            'datail' => $request->datail,
            'timestamp' => $current_time,
        ];

        // saving the $body data to user_logs table
        $model = UserLog::create($body);

        if($request->ajax() || $api) {
            $user_logs_default = [ 
                ['key'=>'', 'value'=>'Select user logs'], 
                ['key'=>'<new>', 'value'=>'Create new user logs'], 
            ];
            $user_logs_new = UserLog::orderBy('id', 'ASC')->get(['user_log_id as key','id as value'])->toArray();
            $options_list = (array) array_merge($user_logs_default, $user_logs_new);
                
            return response()->json([
                "status"=>"success",
                "options_list"=> $options_list,
                "selected_id"=>$model->user_log_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'User Logs data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/manage-users/user-logs/edit/'.$model->user_log_id)->with(['alert-success'=>'User Logs data saved']);
    }
}