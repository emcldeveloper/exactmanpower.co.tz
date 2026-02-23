<?php
/**
 * @category Application
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

class StoreHandler
{
    /**
     * Store a newly created Account Users in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $rules is set of validation rules
        $rules = [
        	'account_id' => 'required|exists:accounts,account_id',
        	'user_id' => 'required|exists:users,user_id',
        	'role' => 'required',
        ];

        // validate request data before continue
        $validator = Validator::make($request->all(), $rules);

        // if request data is valid it continue 
        // if is invalid return back with errors
        if ($validator->fails()) { 
            if($request->ajax()) {
                return ['errors' => $validator->errors()];
            }

            return redirect()->back()->withErrors($validator)->withInput();
        } 
        
        // $body is the array of data to be save to account_users table 
        $body = [
            'account_id' => $request->account_id,
            'user_id' => $request->user_id,
            'role' => $request->role,
        	'status' => ($request->status)? $request->status: 1,
            'created_at' => $current_time,
            'updated_at' => $current_time,
        ];

        // saving the $body data to account_users table
        $model = AccountUser::create($body);

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
            return redirect($redirect)->with(['alert-success'=>'Account Users data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('manage-users/account-users/edit/'.$model->id)->with(['alert-success'=>'Account Users data saved']);
    }
}