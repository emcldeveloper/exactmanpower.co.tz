<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\UserLog;

use App\Models\UserLog;
use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;

class IndexTableHandler
{
    /**
     * Display a listing of the User Logs.
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
        
        // initialize UserLog model
        $model = (new UserLog)->newQuery();
        
        // check if user request for search
        if($search){
            $search = str_replace(' ', '%', $search);
            // this do the margic for search in $model
            $model->where(function($query) use($search){
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('user_log_id', 'LIKE', "%".$search."%") // match User Log column
                    ->orWhere('account_id', 'LIKE', "%".$search."%") // match Account column
                    ->orWhere('user_id', 'LIKE', "%".$search."%") // match User column
                    ->orWhere('log_id', 'LIKE', "%".$search."%") // match Log column
                    ->orWhere('datail', 'LIKE', "%".$search."%") // match Datail column
                    ->orWhere('timestamp', 'LIKE', "%".$search."%"); // match Timestamp column
            });
        }
        
        // assign model values to $data
        $paginate_list = (object) $model->paginate($limit);

        if($paginate_list->count() == 0) {
            $request->merge(['page' => 1]);
            $paginate_list = (object) $model->paginate($limit);
        }

        $data['user_logs_list'] = $paginate_list;

        // if $api is true return the json data
        if($api) {
            return response()->json($data);
        }

        // if $api is false return the view
        return view('admin.manage-users.user-logs.index-table', $data);
    }
}