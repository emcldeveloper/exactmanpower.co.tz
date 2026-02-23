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

class CreateFormHandler
{
    /**
     * Show the form for creating a new Account Users.
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
            
        // Get and assign all data from Account model to $data
        if(in_array('account_id', $hidden) && request('id')) {
            $data['accounts_list'] = Account::where('id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['accounts_list'] = Account::orderBy('name', 'ASC')->get();
        }
            
        // Get and assign all data from User model to $data
        if(in_array('user_id', $hidden) && request('id')) {
            $data['users_list'] = User::where('id', request('id'))->orderBy('first_name', 'ASC')->get();
        } else {
            $data['users_list'] = User::orderBy('first_name', 'ASC')->get();
        }

        // render and send view to user
        return view('admin.manage-users.account-users.create-form', $data);
    }
}