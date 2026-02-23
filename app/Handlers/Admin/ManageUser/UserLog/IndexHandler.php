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

class IndexHandler
{
    /**
     * Display a listing of the User Logs.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // if $api is true return the json data
        if($api){
            // send data to ui
            return new IndexTableHandler($request, $api);
        }

        // if $api is false return the view
        return view('admin.manage-users.user-logs.index', $data);
    }
}