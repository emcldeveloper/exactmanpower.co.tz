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
use App\Models\AccountOrder;
use App\Models\Post;
use App\Models\AccountUser;
use App\Models\Notification;
use App\Models\UserLog;
use App\Models\Log;
use Illuminate\Http\Request;

class EditFormHandler
{
    /**
     * Show the form for editing the specified Accounts.
     *
     * @param  int  $id
     * @param  \App\Models\Account  $accounts
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, Account $accounts, $id = null, $redirect = null, $hidden = [])
    {

        // initialize data to send to the view or client
        $data = [];

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $accounts to $data
        $data['model_info'] = $accounts->where('id', $id)->first();
            
        // Get and assign all data from User model to $data
        if(in_array('account_id', $hidden) && request('id')) {
            $data['users_list'] = User::where('account_id', request('id'))->orderBy('first_name', 'ASC')->get();
        } else {
            $data['users_list'] = User::orderBy('first_name', 'ASC')->get();
        }
            
        // Get and assign all data from Location model to $data
        if(in_array('account_id', $hidden) && request('id')) {
            $data['locations_list'] = Location::where('account_id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['locations_list'] = Location::orderBy('name', 'ASC')->get();
        }

        // Get and assign all data from AccountOrder model to $data
        $data['model_account_orders_list'] = AccountOrder::where('account_id', $id)
                ->pluck('account_order_id')
                ->toArray();
        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();
        // Get and assign all data from AccountUser model to $data
        $data['account_users_list'] = AccountUser::orderBy('id', 'ASC')->get();

        // Get and assign all data from AccountUser model to $data
        $data['model_account_users_list'] = AccountUser::where('account_id', $id)
                ->pluck('account_user_id')
                ->toArray();
        // Get and assign child child all data from User model to $data
        $data['users_list'] = User::orderBy('first_name', 'ASC')->get();

        // Get and assign all data from Notification model to $data
        $data['model_notifications_list'] = Notification::where('account_id', $id)
                ->pluck('notification_id')
                ->toArray();

        // Get and assign all data from UserLog model to $data
        $data['model_user_logs_list'] = UserLog::where('account_id', $id)
                ->pluck('user_log_id')
                ->toArray();
        // Get and assign child child all data from Log model to $data
        $data['logs_list'] = Log::orderBy('name', 'ASC')->get();

        // render and send view to user
        return view('admin.manage-users.accounts.edit-form', $data);
    }
}