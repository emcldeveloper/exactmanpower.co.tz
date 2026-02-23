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

class EditHandler
{
    /**
     * Show the form for editing the specified Logs.
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

        $data['logs'] = new Log();

        // Get and assign all data from $Log to $data
        $data['model_info'] = Log::where('log_id', $log_id)->first();

        // render and send view to user
        return view('admin.manage-users.logs.edit', $data);
    }
}