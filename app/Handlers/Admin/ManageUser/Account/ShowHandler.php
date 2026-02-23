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
use App\Models\AccountUser;
use App\Models\Notification;
use App\Models\UserLog;
use Illuminate\Http\Request;

class ShowHandler
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
    public static function handler(Request $request, Account $accounts, $id = null)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $accounts to $data
        $data['model_info'] = $accounts->where('id', $id)->first();
        
        // Get and assign all data from Account model to $data
        $data['model_list'] = Account::get();

        // render and send view to user
        return view('admin.manage-users.accounts.show', $data);
    }
}