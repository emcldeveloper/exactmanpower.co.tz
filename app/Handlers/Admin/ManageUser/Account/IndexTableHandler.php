<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\Account;

use App\Models\Account;
use App\Models\User;
use App\Models\Location;
use App\Models\AccountOrder;
use App\Models\AccountUser;
use App\Models\Notification;
use App\Models\UserLog;
use Illuminate\Http\Request;

class IndexTableHandler
{
    /**
     * Display a listing of the Accounts.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');
        
        // initialize Account model
        $model = (new Account)->newQuery();
        
        // check if user request for search
        if($search){
            // this do the margic for search in $model
            $model->where(function($query) use($search){
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('account_id', 'LIKE', "%".$search."%") // match Account column
                    ->orWhere('name', 'LIKE', "%".$search."%") // match Name column
                    ->orWhere('user_id', 'LIKE', "%".$search."%") // match User column
                    ->orWhere('logo', 'LIKE', "%".$search."%") // match Logo column
                    ->orWhere('type', 'LIKE', "%".$search."%") // match Type column
                    ->orWhere('address', 'LIKE', "%".$search."%") // match Address column
                    ->orWhere('email', 'LIKE', "%".$search."%") // match Email column
                    ->orWhere('phone', 'LIKE', "%".$search."%") // match Phone column
                    ->orWhere('mobile', 'LIKE', "%".$search."%") // match Mobile column
                    ->orWhere('fax', 'LIKE', "%".$search."%") // match Fax column
                    ->orWhere('location_id', 'LIKE', "%".$search."%") // match Location column
                    ->orWhere('currency', 'LIKE', "%".$search."%") // match Currency column
                    ->orWhere('language', 'LIKE', "%".$search."%") // match Language column
                    ->orWhere('created_at', 'LIKE', "%".$search."%") // match Created Time column
                    ->orWhere('updated_at', 'LIKE', "%".$search."%"); // match Updated Time column
            });
        }

        // assign model values to $data
        $data['accounts_list'] = (object) $model->paginate($limit);

        // if $api is true return the json data
        if($api){
            // send data to ui
            return $data;
        }

        // if $api is false return the view
        return view('admin.manage-users.accounts.index-table', $data);
    }
}