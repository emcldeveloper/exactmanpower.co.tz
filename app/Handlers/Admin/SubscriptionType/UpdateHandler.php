<?php
/**
 * @category Method handler
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

class UpdateHandler
{
    /**
     * Update the specified Subscription Types in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $subscription_type_id = null, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = SubscriptionType::where('subscription_type_id', $subscription_type_id)->first();

        // initialize $body: data that need to be updated
        $body = [];
        if(isset($inputs->subscription_type_id)) $body['subscription_type_id'] = $inputs->subscription_type_id; // check if field 'subscription_type_id' exist from the request and then add it to $body
        if(isset($inputs->name)) $body['name'] = $inputs->name; // check if field 'name' exist from the request and then add it to $body
        
        // if there is data to update then update
        if(count($body)){
            // update subscription_types table
            $model->update($body);
        }

        if($request->ajax() || $api) {
            $subscription_types_default = [ 
                ['id'=>'', 'name'=>'Select subscription types'], 
                ['id'=>'<new>', 'name'=>'Create new subscription types'], 
            ];
            $subscription_types_new = SubscriptionType::orderBy('name', 'ASC')->get(['subscription_type_id as id','name as name'])->toArray();
            $subscription_types_list = (array) array_merge($subscription_types_default, $subscription_types_new);
                
            return response()->json([
                "status"=>"success",
                "subscription_types_list"=> $subscription_types_list,
                "selected_id"=>$model->subscription_type_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Subscription Types data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Subscription Types data updated']);
    }
}