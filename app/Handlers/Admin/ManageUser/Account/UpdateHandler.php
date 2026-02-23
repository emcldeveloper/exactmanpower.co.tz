<?php
/**
 * @category Method handler
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

class UpdateHandler
{
    /**
     * Update the specified Accounts in storage.
     *
     * @param  int  $id
     * @param  \App\Models\Account  $accounts
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, Account $accounts, $id = null, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = $accounts->where('id', $id);

        // initialize $body: data that need to be updated
        $body = [];
        
        // check if field 'account_id' exist from the request and then add it to $body
        if(isset($inputs->account_id)) $body['account_id'] = $inputs->account_id;
        
        // check if field 'name' exist from the request and then add it to $body
        if(isset($inputs->name)) $body['name'] = $inputs->name;
        
        // check if field 'user_id' exist from the request and then add it to $body
        if(isset($inputs->user_id)) $body['user_id'] = $inputs->user_id;
        
        // check if field 'logo' exist from the request and then add it to $body
        $uploaded_logo = self::save_uploaded_logo($request);
        if(isset($uploaded_logo)) $body['logo'] = $uploaded_logo;
        
        // check if field 'type' exist from the request and then add it to $body
        if(isset($inputs->type)) $body['type'] = ($inputs->type)? $inputs->type: 0;
        
        // check if field 'address' exist from the request and then add it to $body
        if(isset($inputs->address)) $body['address'] = $inputs->address;
        
        // check if field 'email' exist from the request and then add it to $body
        if(isset($inputs->email)) $body['email'] = $inputs->email;
        
        // check if field 'phone' exist from the request and then add it to $body
        if(isset($inputs->phone)) $body['phone'] = $inputs->phone;
        
        // check if field 'mobile' exist from the request and then add it to $body
        if(isset($inputs->mobile)) $body['mobile'] = $inputs->mobile;
        
        // check if field 'fax' exist from the request and then add it to $body
        if(isset($inputs->fax)) $body['fax'] = $inputs->fax;
        
        // check if field 'location_id' exist from the request and then add it to $body
        if(isset($inputs->location_id)) $body['location_id'] = $inputs->location_id;
        
        // check if field 'currency' exist from the request and then add it to $body
        if(isset($inputs->currency)) $body['currency'] = $inputs->currency;
        
        // check if field 'language' exist from the request and then add it to $body
        if(isset($inputs->language)) $body['language'] = $inputs->language;
        
        // check if field 'created_at' exist from the request and then add it to $body
        if(isset($inputs->created_at)) $body['created_at'] = $inputs->created_at;
        
        // check if field 'updated_at' exist from the request and then add it to $body
        $body['updated_at'] =  $current_time;
        
        // if there is data to update then update
        if(count($body)){
            // update accounts table
            $model->update($body);
        }
        if(is_array($request->account_users_list)) {
            AccountUser::where('id', $id)->delete();
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
            return redirect($redirect)->with(['alert-success'=>'Accounts data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Accounts data updated']);
    }
    private function save_uploaded_logo(Request $request)
    {
        try {
            $file = $request->file('logo');
            $filename = Str::slug(time() . "-" . $file->getClientOriginalName(), '-');
            $file_directory = public_path('uploaded');

            $file->move($file_directory, $filename);
        } catch (\Exception $exception) {
            $filename = null;
            Log::error(Helper::logException($exception));
        }

        return $filename;
    }
}