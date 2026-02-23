<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\SubscriptionType;

use App\Models\SubscriptionType;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified Subscription Types from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $subscription_type_id = null, $api = false)
    {
        // Find Subscription Types from subscription_types table and delete
        SubscriptionType::where('subscription_type_id', $subscription_type_id)->delete();

        if($api) {
            return response()->json(['status'=>'success', 'message'=>'Subscription Types data deleted']);
        }

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'Subscription Types data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'Subscription Types data deleted']);
    }
}