<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\Log;

use Helper;
use Validator;
use App\Models\Log;
use App\Models\UserLog;
use Illuminate\Http\Request;

class StoreHandler
{
    /**
     * Store a newly created Logs in storage.
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
        	'name' => 'required',
        	'url' => 'required',
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
        
        // $body is the array of data to be save to logs table 
        $body = [
            'name' => $request->name,
            'url' => $request->url,
        ];

        // saving the $body data to logs table
        $model = Log::create($body);
        if($model) {
            if(is_array($request->user_logs_list)) {
                foreach($request->user_logs_list as $index => $item) {
                    UserLog::create([
                        'account_id' => $item['account_id'],
                        'user_id' => $item['user_id'],
                        'log_id' => $model->log_id,
                        'datail' => $item['datail'],
                        'timestamp' => $current_time,
                    ]);
                }
            }
        }

        if($request->ajax() || $api) {
            $logs_default = [ 
                ['key'=>'', 'value'=>'Select logs'], 
                ['key'=>'<new>', 'value'=>'Create new logs'], 
            ];
            $logs_new = Log::orderBy('name', 'ASC')->get(['log_id as key','name as value'])->toArray();
            $options_list = (array) array_merge($logs_default, $logs_new);
                
            return response()->json([
                "status"=>"success",
                "options_list"=> $options_list,
                "selected_id"=>$model->log_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Logs data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/manage-users/logs/edit/'.$model->log_id)->with(['alert-success'=>'Logs data saved']);
    }
}