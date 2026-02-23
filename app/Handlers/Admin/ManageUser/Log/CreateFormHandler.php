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

class CreateFormHandler
{
    /**
     * Show the form for creating a new Logs.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];

        // Set $redirect
        $data['redirect'] = $redirect;
        
        // Set $hidden field and value
        foreach($hidden as $key => $value){
            $data[$key] = $value;
            $data['hidden'][] = $key;
        }
        // Get and assign all data from UserLog model to $data
        $data['user_logs_list'] = UserLog::orderBy('id', 'ASC')->get();

        // Get and assign all data from UserLog model to $data
        $data['model_user_logs_list'] = [];

        // Get and assign child child all data from User model to $data
        $data['users_list'] = User::orderBy('first_name', 'ASC')->get();

        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.manage-users.logs.create-form', $data);
    }
}