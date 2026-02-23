<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\AccountUser;

use App\Models\AccountUser;
use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;

class IndexTableHandler
{
    /**
     * Display a listing of the Account Users.
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
        
        // initialize AccountUser model
        $model = (new AccountUser)->newQuery();
        
        // check if user request for search
        if($search){
            // this do the margic for search in $model
            $model->where(function($query) use($search){
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('account_user_id', 'LIKE', "%".$search."%") // match Account User column
                    ->orWhere('account_id', 'LIKE', "%".$search."%") // match Account column
                    ->orWhere('user_id', 'LIKE', "%".$search."%") // match User column
                    ->orWhere('role', 'LIKE', "%".$search."%") // match Role column
                    ->orWhere('status', 'LIKE', "%".$search."%") // match Status column
                    ->orWhere('created_at', 'LIKE', "%".$search."%") // match Created Time column
                    ->orWhere('updated_at', 'LIKE', "%".$search."%"); // match Updated Time column
            });
        }

        // assign model values to $data
        $data['account_users_list'] = (object) $model->paginate($limit);

        // if $api is true return the json data
        if($api){
            // send data to ui
            return $data;
        }

        // if $api is false return the view
        return view('admin.manage-users.account-users.index-table', $data);
    }
}