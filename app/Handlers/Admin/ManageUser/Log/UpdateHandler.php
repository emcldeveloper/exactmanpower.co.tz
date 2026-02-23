<?php
/**
 * @category Method handler
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

class UpdateHandler
{
    /**
     * Update the specified Logs in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $log_id = null, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = Log::where('log_id', $log_id)->first();

        // initialize $body: data that need to be updated
        $body = [];
        if(isset($inputs->log_id)) $body['log_id'] = $inputs->log_id; // check if field 'log_id' exist from the request and then add it to $body
        if(isset($inputs->name)) $body['name'] = $inputs->name; // check if field 'name' exist from the request and then add it to $body
        if(isset($inputs->url)) $body['url'] = $inputs->url; // check if field 'url' exist from the request and then add it to $body
        
        // if there is data to update then update
        if(count($body)){
            // update logs table
            $model->update($body);
        }
        if(is_array($request->user_logs_list)) {
            $updated_ids = [];
            $old_ids = UserLog::where('log_id', $model->log_id)->pluck('user_log_id')->toArray();
            foreach($request->user_logs_list as $index => $item) {
                $sub_body = [
                    'account_id' => $item['account_id'],
                    'user_id' => $item['user_id'],
                    'log_id' => $model->log_id,
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
            $logs_default = [ 
                ['id'=>'', 'name'=>'Select logs'], 
                ['id'=>'<new>', 'name'=>'Create new logs'], 
            ];
            $logs_new = Log::orderBy('name', 'ASC')->get(['log_id as id','name as name'])->toArray();
            $logs_list = (array) array_merge($logs_default, $logs_new);
                
            return response()->json([
                "status"=>"success",
                "logs_list"=> $logs_list,
                "selected_id"=>$model->log_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Logs data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Logs data updated']);
    }
}