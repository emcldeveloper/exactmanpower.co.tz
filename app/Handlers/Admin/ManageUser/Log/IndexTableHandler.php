<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\Log;

use App\Models\Log;
use App\Models\UserLog;
use Illuminate\Http\Request;

class IndexTableHandler
{
    /**
     * Display a listing of the Logs.
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
        
        // initialize Log model
        $model = (new Log)->newQuery();
        
        // check if user request for search
        if($search){
            $search = str_replace(' ', '%', $search);
            // this do the margic for search in $model
            $model->where(function($query) use($search){
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('log_id', 'LIKE', "%".$search."%") // match Log column
                    ->orWhere('name', 'LIKE', "%".$search."%") // match Name column
                    ->orWhere('url', 'LIKE', "%".$search."%"); // match Url column
            });
        }
        
        // assign model values to $data
        $paginate_list = (object) $model->paginate($limit);

        if($paginate_list->count() == 0) {
            $request->merge(['page' => 1]);
            $paginate_list = (object) $model->paginate($limit);
        }

        $data['logs_list'] = $paginate_list;

        // if $api is true return the json data
        if($api) {
            return response()->json($data);
        }

        // if $api is false return the view
        return view('admin.manage-users.logs.index-table', $data);
    }
}