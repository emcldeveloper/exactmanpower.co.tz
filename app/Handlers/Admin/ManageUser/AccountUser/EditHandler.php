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

class EditHandler
{
    /**
     * Show the form for editing the specified Account Users.
     *
     * @param  int  $id
     * @param  \App\Models\AccountUser $account_users
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, AccountUser $account_users, $id = null)
    {

        // initialize data to send to the view or client
        $data = [];

        $data['account_users'] = new AccountUser();

        // Get and assign all data from $account_users to $data
        $data['model'] = $account_users->where('id', $id)->first();

        // render and send view to user
        return view('admin.manage-users.account-users.edit', $data);
    }
}