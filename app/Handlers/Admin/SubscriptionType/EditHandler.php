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

class EditHandler
{
    /**
     * Show the form for editing the specified Subscription Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $subscription_type_id = null, $api = false)
    {

        // initialize data to send to the view or client
        $data = [];

        $data['subscription_types'] = new SubscriptionType();

        // Get and assign all data from $SubscriptionType to $data
        $data['model_info'] = SubscriptionType::where('subscription_type_id', $subscription_type_id)->first();

        // render and send view to user
        return view('admin.subscription-types.edit', $data);
    }
}