<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\SubscriptionType;

use Helper;
use Validator;
use App\Models\SubscriptionType;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class StoreHandler
{
    /**
     * Store a newly created Subscription Types in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $rules is set of validation rules
        $rules = [
        	'name' => 'required',
        ];

        // validate request data before continue
        $validator = Validator::make($request->all(), $rules);

        // if request data is valid it continue 
        // if is invalid return back with errors
        if ($validator->fails()) { 
            if($request->ajax() || $api) {
                return response()->json(['errors' => $validator->errors()]);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        } 
        
        // $body is the array of data to be save to subscription_types table 
        $body = [
            'name' => $request->name,
        ];

        // saving the $body data to subscription_types table
        $model = SubscriptionType::create($body);

        if($request->ajax() || $api) {
            $subscription_types_default = [ 
                ['key'=>'', 'value'=>'Select subscription types'], 
                ['key'=>'<new>', 'value'=>'Create new subscription types'], 
            ];
            $subscription_types_new = SubscriptionType::orderBy('name', 'ASC')->get(['subscription_type_id as key','name as value'])->toArray();
            $options_list = (array) array_merge($subscription_types_default, $subscription_types_new);
                
            return response()->json([
                "status"=>"success",
                "options_list"=> $options_list,
                "selected_id"=>$model->subscription_type_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Subscription Types data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/subscription-types/edit/'.$model->subscription_type_id)->with(['alert-success'=>'Subscription Types data saved']);
    }
}