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

class CreateFormHandler
{
    /**
     * Show the form for creating a new User Logs.
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
            
        // Get and assign all data from User model to $data
        if(in_array('user_id', $hidden) && request('id')) {
            $data['users_list'] = User::where('id', request('id'))->orderBy('first_name', 'ASC')->get();
        } else {
            $data['users_list'] = User::orderBy('first_name', 'ASC')->get();
        }
            
        // Get and assign all data from Log model to $data
        if(in_array('log_id', $hidden) && request('id')) {
            $data['logs_list'] = Log::where('id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['logs_list'] = Log::orderBy('name', 'ASC')->get();
        }

        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.manage-users.user-logs.create-form', $data);
    }
}