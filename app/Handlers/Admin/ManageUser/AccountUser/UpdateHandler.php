<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\AccountUser;

use Validator;
use App\Models\AccountUser;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateHandler
{
    /**
     * Update the specified Account Users in storage.
     *
     * @param  int  $id
     * @param  \App\Models\AccountUser  $account_users
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, AccountUser $account_users, $id = null, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = $account_users->where('id', $id);

        // initialize $body: data that need to be updated
        $body = [];
        
        // check if field 'account_user_id' exist from the request and then add it to $body
        if(isset($inputs->account_user_id)) $body['account_user_id'] = $inputs->account_user_id;
        
        // check if field 'account_id' exist from the request and then add it to $body
        if(isset($inputs->account_id)) $body['account_id'] = $inputs->account_id;
        
        // check if field 'user_id' exist from the request and then add it to $body
        if(isset($inputs->user_id)) $body['user_id'] = $inputs->user_id;
        
        // check if field 'role' exist from the request and then add it to $body
        if(isset($inputs->role)) $body['role'] = $inputs->role;
        
        // check if field 'status' exist from the request and then add it to $body
        if(isset($inputs->status)) $body['status'] = ($inputs->status)? $inputs->status: 0;
        
        // check if field 'created_at' exist from the request and then add it to $body
        if(isset($inputs->created_at)) $body['created_at'] = $inputs->created_at;
        
        // check if field 'updated_at' exist from the request and then add it to $body
        $body['updated_at'] =  $current_time;
        
        // if there is data to update then update
        if(count($body)){
            // update account_users table
            $model->update($body);
        }

        if($request->ajax()) {
            $account_users_default = [ 
                ['id'=>'', 'name'=>'Select account users'], 
                ['id'=>'<new>', 'name'=>'Create new account users'], 
            ];
            $account_users_new = AccountUser::orderBy('id', 'ASC')->get(['account_user_id as id','id as name'])->toArray();
            $account_users_list = (array) array_merge($account_users_default, $account_users_new);
                
            return [
                "status"=>"success",
                "account_users_list"=> $account_users_list,
                "selected_id"=>$model->account_user_id
            ];
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Account Users data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Account Users data updated']);
    }
}