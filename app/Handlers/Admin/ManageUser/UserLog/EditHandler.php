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

class EditHandler
{
    /**
     * Show the form for editing the specified User Logs.
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

        $data['user_logs'] = new UserLog();

        // Get and assign all data from $UserLog to $data
        $data['model_info'] = UserLog::where('user_log_id', $user_log_id)->first();

        // render and send view to user
        return view('admin.manage-users.user-logs.edit', $data);
    }
}