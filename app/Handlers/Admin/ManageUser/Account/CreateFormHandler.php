<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\Account;

use App\Models\Account;
use App\Models\User;
use App\Models\Location;
use App\Models\Post;
use App\Models\AccountUser;
use App\Models\Log;
use Illuminate\Http\Request;

class CreateFormHandler
{
    /**
     * Show the form for creating a new Accounts.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $redirect = null, $hidden = [])
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
            
        // Get and assign all data from Location model to $data
        if(in_array('location_id', $hidden) && request('id')) {
            $data['locations_list'] = Location::where('id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['locations_list'] = Location::orderBy('name', 'ASC')->get();
        }

        // Get and assign all data from AccountOrder model to $data
        $data['model_account_orders_list'] = [];

        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();
        // Get and assign all data from AccountUser model to $data
        $data['account_users_list'] = AccountUser::orderBy('id', 'ASC')->get();

        // Get and assign all data from AccountUser model to $data
        $data['model_account_users_list'] = [];

        // Get and assign all data from Notification model to $data
        $data['model_notifications_list'] = [];

        // Get and assign all data from UserLog model to $data
        $data['model_user_logs_list'] = [];

        // Get and assign child child all data from Log model to $data
        $data['logs_list'] = Log::orderBy('name', 'ASC')->get();

        // render and send view to user
        return view('admin.manage-users.accounts.create-form', $data);
    }
}