<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\AccountUser;

use App\Models\AccountUser;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class ShowFormHandler
{
    /**
     * Display the specified Account Users.
     *
     * @param  int  $id
     * @param  \App\Models\AccountUser  $account_users
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, AccountUser $account_users, $id = null, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];
        $data['is_namespace'] = null;
        $sub_page = request('sub_page')? request('sub_page'): 'form';

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $account_users to $data
        $data['model_info'] = $account_users->where('id', $id)->first();

        

        if($sub_page === 'form' || $sub_page === 'edit') {
            $model_list = self::form($request, $account_users, $id);

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
        

        return view('admin.manage-users.account-users.'.$sub_view, $data);
    }
    
    /**
     * Display the specified Account Users.
     *
     * @param  int  $id
     * @param  \App\Models\AccountUser  $account_users
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function form(Request $request, AccountUser $account_users, $id = null, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];
            
        // Get and assign all data from Account model to $data
        if(in_array('account_user_id', $hidden) && request('id')) {
            $data['accounts_list'] = Account::where('account_user_id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['accounts_list'] = Account::orderBy('name', 'ASC')->get();
        }
            
        // Get and assign all data from User model to $data
        if(in_array('account_user_id', $hidden) && request('id')) {
            $data['users_list'] = User::where('account_user_id', request('id'))->orderBy('first_name', 'ASC')->get();
        } else {
            $data['users_list'] = User::orderBy('first_name', 'ASC')->get();
        }

        // return and send data to user
        return $data;
    }
}