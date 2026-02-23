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
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified Accounts from storage.
     *
     * @param  int  $id
     * @param  \App\Models\Account  $accounts
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, Account $accounts, $id = null)
    {
        // Find logo file
        self::delete_logo($accounts, $id);
        // Find Accounts from accounts table and delete
        $accounts->where('id', $id)->delete();

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'Accounts data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'Accounts data deleted']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account $accounts
     * @return \Illuminate\Http\Response
     */
    public static function delete_logo(Account $accounts, $id = null)
    {
        $model = $accounts->where('id', $id)->first();
        if($model){
            $filename = public_path('uploaded/'.$model->logo);
            if(File::exists($filename)){
                File::delete($filename);
            }
        }
    }
}