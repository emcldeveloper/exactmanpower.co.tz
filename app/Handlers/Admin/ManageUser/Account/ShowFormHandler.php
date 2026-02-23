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

class ShowFormHandler
{
    /**
     * Display the specified Accounts.
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
        $data['is_namespace'] = null;
        $sub_page = request('sub_page')? request('sub_page'): 'form';

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $accounts to $data
        $data['model_info'] = $accounts->where('id', $id)->first();

        if($sub_page == 'account-orders') {
            $data['sub_page_list'] = self::account_orders($request, $id);
        } else if($sub_page == 'notifications') {
            $data['sub_page_list'] = self::notifications($request, $id);
        } else if($sub_page == 'user-logs') {
            $data['sub_page_list'] = self::user_logs($request, $id);
        }

        if($sub_page === 'form' || $sub_page === 'edit') {
            $model_list = self::form($request, $accounts, $id);

            $data['is_namespace'] = 'manage-users.';
            foreach ($model_list as $key => $value) {
                $data[$key] = $value;
            }
        }

        // render and send view to user
        $sub_view = 'show-form';
        if($sub_page == 'edit') {
            $sub_view = 'show-edit';
        }
        elseif($sub_page == 'account-orders') {
            $sub_view = 'show-account-orders';
        } else if($sub_page == 'notifications') {
            $sub_view = 'show-notifications';
        } else if($sub_page == 'user-logs') {
            $sub_view = 'show-user-logs';
        }

        return view('admin.manage-users.accounts.'.$sub_view, $data);
    }
    
    /**
     * Display the specified Accounts.
     *
     * @param  int  $id
     * @param  \App\Models\Account  $accounts
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function form(Request $request, Account $accounts, $id = null, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];
            
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
                
        // Get and assign child data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();

        // Get and assign all data from AccountUser model to $data
        $data['account_users_list'] = AccountUser::orderBy('id', 'ASC')->get();

        // Get and assign all data from AccountUser model to $data
        $data['model_account_users_list'] = AccountUser::where('account_id', $id)
                ->pluck('account_user_id')
                ->toArray();
                

        // Get and assign all data from Notification model to $data
        $data['model_notifications_list'] = Notification::where('account_id', $id)
                ->pluck('notification_id')
                ->toArray();
                

        // Get and assign all data from UserLog model to $data
        $data['model_user_logs_list'] = UserLog::where('account_id', $id)
                ->pluck('user_log_id')
                ->toArray();
                
        // Get and assign child data from Log model to $data
        $data['logs_list'] = Log::orderBy('name', 'ASC')->get();

        // return and send data to user
        return $data;
    }
                
    /**
     * Display the specified Account Orders.
     *
     * @param  int  $id
     * @param  \App\Models\AccountOrder $account_orders
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function account_orders(Request $request, $id = null)
    {
        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');

        // $account_id is unique id of the Account
        $account_id = Account::where('id', $id)->value('account_id');
        
        // initialize AccountOrder model
        $model = AccountOrder::where('account_id', $account_id);
        
        // check if user request for search
        if($search){
            // this do the margic for search in $model
            $model->where(function($query) use($search) {
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('account_order_id', 'LIKE', "%".$search."%") // match Account Order column
                    ->orWhere('account_id', 'LIKE', "%".$search."%") // match Account column
                    ->orWhere('post_id', 'LIKE', "%".$search."%") // match Post column
                    ->orWhere('amount', 'LIKE', "%".$search."%") // match Amount column
                    ->orWhere('is_paid', 'LIKE', "%".$search."%") // match Is Paid column
                    ->orWhere('status', 'LIKE', "%".$search."%") // match Status column
                    ->orWhere('created_at', 'LIKE', "%".$search."%") // match Created Time column
                    ->orWhere('updated_at', 'LIKE', "%".$search."%"); // match Updated Time column
            });
        }

        // assign model values to $data
        $data = (object) $model->paginate($limit);

        // return and send view to user
        return $data;
    }
                
    /**
     * Display the specified Notifications.
     *
     * @param  int  $id
     * @param  \App\Models\Notification $notifications
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function notifications(Request $request, $id = null)
    {
        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');

        // $account_id is unique id of the Account
        $account_id = Account::where('id', $id)->value('account_id');
        
        // initialize Notification model
        $model = Notification::where('account_id', $account_id);
        
        // check if user request for search
        if($search){
            // this do the margic for search in $model
            $model->where(function($query) use($search) {
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('notification_id', 'LIKE', "%".$search."%") // match Notification column
                    ->orWhere('account_id', 'LIKE', "%".$search."%") // match Account column
                    ->orWhere('title', 'LIKE', "%".$search."%") // match Title column
                    ->orWhere('content', 'LIKE', "%".$search."%") // match Content column
                    ->orWhere('link', 'LIKE', "%".$search."%") // match Link column
                    ->orWhere('post_id', 'LIKE', "%".$search."%") // match Post column
                    ->orWhere('type', 'LIKE', "%".$search."%") // match Type column
                    ->orWhere('status', 'LIKE', "%".$search."%") // match Status column
                    ->orWhere('timestamp', 'LIKE', "%".$search."%"); // match Timestamp column
            });
        }

        // assign model values to $data
        $data = (object) $model->paginate($limit);

        // return and send view to user
        return $data;
    }
                
    /**
     * Display the specified User Logs.
     *
     * @param  int  $id
     * @param  \App\Models\UserLog $user_logs
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function user_logs(Request $request, $id = null)
    {
        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');

        // $account_id is unique id of the Account
        $account_id = Account::where('id', $id)->value('account_id');
        
        // initialize UserLog model
        $model = UserLog::where('account_id', $account_id);
        
        // check if user request for search
        if($search){
            // this do the margic for search in $model
            $model->where(function($query) use($search) {
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('user_log_id', 'LIKE', "%".$search."%") // match User Log column
                    ->orWhere('account_id', 'LIKE', "%".$search."%") // match Account column
                    ->orWhere('user_id', 'LIKE', "%".$search."%") // match User column
                    ->orWhere('log_id', 'LIKE', "%".$search."%") // match Log column
                    ->orWhere('datail', 'LIKE', "%".$search."%") // match Datail column
                    ->orWhere('timestamp', 'LIKE', "%".$search."%"); // match Timestamp column
            });
        }

        // assign model values to $data
        $data = (object) $model->paginate($limit);

        // return and send view to user
        return $data;
    }
}