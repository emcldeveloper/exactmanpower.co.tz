<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\Account;

use Validator;
use App\Models\Account;
use App\Models\User;
use App\Models\Location;
use App\Models\AccountOrder;
use App\Models\AccountUser;
use App\Models\Notification;
use App\Models\UserLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\SupportFacades\Log;

class StoreHandler
{
    /**
     * Store a newly created Accounts in storage.
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
        	'name' => 'required',
        	'user_id' => 'required|exists:users,user_id',
        	'type' => 'required',
        	'address' => 'required',
        	'email' => 'required|string|email|max:255|unique:users,email',
        	'phone' => 'required',
        	'mobile' => 'required',
        	'fax' => 'required',
        	'location_id' => 'required|exists:locations,location_id',
        	'currency' => 'required',
        	'language' => 'required',
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
        $save_uploaded_logo = self::save_uploaded_logo($request);
        
        // $body is the array of data to be save to accounts table 
        $body = [
            'name' => $request->name,
            'user_id' => $request->user_id,
        	'logo' => $save_uploaded_logo,
        	'type' => ($request->type)? $request->type: 1,
        	'address' => ($request->address)? $request->address: "",
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'fax' => $request->fax,
            'location_id' => $request->location_id,
            'currency' => $request->currency,
            'language' => $request->language,
            'created_at' => $current_time,
            'updated_at' => $current_time,
        ];

        // saving the $body data to accounts table
        $model = Account::create($body);
        if($model) {
            if(is_array($request->account_users_list)) {
                for ($i = 0; $i < count($request->account_users_list); $i++) {
                    AccountUser::create([
                        'account_id' => $model->account_id,
                        'user_id' => "",
                        'role' => "",
                        'status' => "",
                        'created_at' => $current_time,
                        'updated_at' => $current_time,
                    ]);
                }
            }
        }

        if($request->ajax()) {
            $accounts_default = [ 
                ['id'=>'', 'name'=>'Select accounts'], 
                ['id'=>'<new>', 'name'=>'Create new accounts'], 
            ];
            $accounts_new = Account::orderBy('name', 'ASC')->get(['account_id as id','name as name'])->toArray();
            $accounts_list = (array) array_merge($accounts_default, $accounts_new);
                
            return [
                "status"=>"success",
                "accounts_list"=> $accounts_list,
                "selected_id"=>$model->account_id
            ];
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Accounts data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('manage-users/accounts/edit/'.$model->id)->with(['alert-success'=>'Accounts data saved']);
    }
    public static function save_uploaded_logo(Request $request)
    {
        try {
            $filename = null;
            $file = $request->file('logo');
            if($file) {
                $filename = Str::slug(time() . "-" . $file->getClientOriginalName(), '-');
                $file_directory = public_path('uploaded');
    
                $file->move($file_directory, $filename);
            }
        } catch (\Exception $exception) {
            $filename = null;
            Log::error(Helper::logException($exception));
        }

        return $filename;
    }
}