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
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified Account Users from storage.
     *
     * @param  int  $id
     * @param  \App\Models\AccountUser  $account_users
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, AccountUser $account_users, $id = null)
    {
        // Find Account Users from account_users table and delete
        $account_users->where('id', $id)->delete();

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'Account Users data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'Account Users data deleted']);
    }
}