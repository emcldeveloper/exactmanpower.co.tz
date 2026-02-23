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
use Illuminate\Http\Request;

class ShowHandler
{
    /**
     * Display the specified Logs.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $log_id = null, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $logs to $data
        $data['model_info'] = Log::where('log_id', $log_id)->first();
        
        // Get and assign all data from Log model to $data
        $data['model_list'] = Log::get();

        if($api) {
            return new ShowFormHandler($request, $log_id, $api);
        }

        // render and send view to user
        return view('admin.manage-users.logs.show', $data);
    }
}