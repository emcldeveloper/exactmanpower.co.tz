<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\Log;

use App\Models\Log;
use App\Models\UserLog;
use App\Models\User;
use Illuminate\Http\Request;

class EditFormHandler
{
    /**
     * Show the form for editing the specified Logs.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $log_id = null, $api = false, $redirect = null, $hidden = [])
    {

        // initialize data to send to the view or client
        $data = [];

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $logs to $data
        $data['model_info'] = Log::where('log_id', $log_id)->first();
        // Get and assign all data from UserLog model to $data
        $data['user_logs_list'] = UserLog::orderBy('id', 'ASC')->get();

        // Get and assign all data from UserLog model to $data
        $data['model_user_logs_list'] = UserLog::where('log_id', $log_id)
                ->pluck('user_log_id')
                ->toArray();
        // Get and assign child child all data from User model to $data
        $data['users_list'] = User::orderBy('first_name', 'ASC')->get();
        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.manage-users.logs.edit-form', $data);
    }
}