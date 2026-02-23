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

class ShowHandler
{
    /**
     * Display the specified User Logs.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $user_log_id = null, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $user_logs to $data
        $data['model_info'] = UserLog::where('user_log_id', $user_log_id)->first();
        
        // Get and assign all data from UserLog model to $data
        $data['model_list'] = UserLog::get();

        if($api) {
            return new ShowFormHandler($request, $user_log_id, $api);
        }

        // render and send view to user
        return view('admin.manage-users.user-logs.show', $data);
    }
}