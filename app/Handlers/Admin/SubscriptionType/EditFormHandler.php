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

class EditFormHandler
{
    /**
     * Show the form for editing the specified Subscription Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $subscription_type_id = null, $api = false, $redirect = null, $hidden = [])
    {

        // initialize data to send to the view or client
        $data = [];

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $subscription_types to $data
        $data['model_info'] = SubscriptionType::where('subscription_type_id', $subscription_type_id)->first();

        // Get and assign all data from Subscriber model to $data
        $data['model_subscribers_list'] = Subscriber::where('subscription_type_id', $subscription_type_id)
                ->pluck('subscriber_id')
                ->toArray();
        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.subscription-types.edit-form', $data);
    }
}