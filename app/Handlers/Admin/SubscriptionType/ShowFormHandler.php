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

class ShowFormHandler
{
    /**
     * Display the specified Subscription Types.
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
        $data['is_namespace'] = null;
        $sub_page = request('sub_page')? request('sub_page'): 'form';

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $subscription_types to $data
        $data['model_info'] = SubscriptionType::where('subscription_type_id', $subscription_type_id)->first();

        if($sub_page == 'subscribers') {
            $data['sub_page_list'] = self::subscribers($request, $subscription_type_id);
        }

        if($sub_page === 'form' || $sub_page === 'edit') {
            $model_list = self::form($request, $subscription_type_id);

            $data['is_namespace'] = '';
            foreach ($model_list as $key => $value) {
                $data[$key] = $value;
            }
        }

        // render and send view to user
        $sub_view = 'show-form';
        if($sub_page == 'edit') {
            $sub_view = 'show-edit';
        }
        elseif($sub_page == 'subscribers') {
            $sub_view = 'show-subscribers';
        }

        if($api) {
            return response()->json($data);
        }

        return view('admin.subscription-types.'.$sub_view, $data);
    }
    
    /**
     * Display the specified Subscription Types.
     *
     * @param  String  $subscription_type_id
     * @param  \App\Models\SubscriptionType  $subscription_types
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function form(Request $request, $subscription_type_id = null, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];

        // return and send data to user
        return $data;
    }
                
    /**
     * Display the specified Subscribers.
     *
     * @param  String  $subscription_type_id
     * @param  \App\Models\Subscriber $subscribers
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function subscribers(Request $request, $subscription_type_id = null)
    {
        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');
        
        // initialize Subscriber model
        $model = Subscriber::where('subscription_type_id', $subscription_type_id);
        
        // check if user request for search
        if($search){
            // this do the margic for search in $model
            $model->where(function($query) use($search) {
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('subscriber_id', 'LIKE', "%".$search."%") // match Subscriber column
                    ->orWhere('email', 'LIKE', "%".$search."%") // match Email column
                    ->orWhere('query', 'LIKE', "%".$search."%") // match Query column
                    ->orWhere('subscription_type_id', 'LIKE', "%".$search."%") // match Subscription Type column
                    ->orWhere('is_valid', 'LIKE', "%".$search."%") // match Is Valid column
                    ->orWhere('status', 'LIKE', "%".$search."%") // match Status column
                    ->orWhere('notes', 'LIKE', "%".$search."%") // match Notes column
                    ->orWhere('timestamp', 'LIKE', "%".$search."%") // match Timestamp column
                    ->orWhere('deactivated_at', 'LIKE', "%".$search."%"); // match Deactivated Time column
            });
        }

        // assign model values to $data
        $data = (object) $model->paginate($limit);

        // return and send view to user
        return $data;
    }
}