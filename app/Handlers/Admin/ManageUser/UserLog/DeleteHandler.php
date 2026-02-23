<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\UserLog;

use App\Models\UserLog;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified User Logs from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $user_log_id = null, $api = false)
    {
        // Find User Logs from user_logs table and delete
        UserLog::where('user_log_id', $user_log_id)->delete();

        if($api) {
            return response()->json(['status'=>'success', 'message'=>'User Logs data deleted']);
        }

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'User Logs data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'User Logs data deleted']);
    }
}