<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;

class IndexContentHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false)
    {
        $data = [];
        $data['total_users'] = User::count();
        $data['total_active_users'] = User::where('status', 1)->count();
        $data['total_inactive_users'] = User::where('status', 0)->count();
        $data['total_admin_users'] = User::where('role', 1)->count();
        $data['summary_list'] = [];

        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');

        // initialize User model
        $model = new User;
        
        // check if user request for search
        if($search){
            // this do the margic for search in $model
            $model->where(function($query) use($search){
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('user_id', 'LIKE', "%".$search."%") // match User column
                    ->orWhere('name', 'LIKE', "%".$search."%") // match Name column
                    ->orWhere('username', 'LIKE', "%".$search."%") // match Username column
                    ->orWhere('email', 'LIKE', "%".$search."%") // match Email column
                    ->orWhere('password', 'LIKE', "%".$search."%") // match Password column
                    ->orWhere('role', 'LIKE', "%".$search."%") // match Role column
                    ->orWhere('token', 'LIKE', "%".$search."%") // match Token column
                    ->orWhere('remember_token', 'LIKE', "%".$search."%") // match Remember Token column
                    ->orWhere('status', 'LIKE', "%".$search."%") // match Status column
                    ->orWhere('created_at', 'LIKE', "%".$search."%") // match Created At column
                    ->orWhere('updated_at', 'LIKE', "%".$search."%"); // match Updated At column
            });
        }

        // assign model values to $data
        $data['summary_list'] = (object) $model->paginate($limit);

        // if $api is true return the json data
        if($api) {
            return response()->json($data);
        }

        // if $api is false return the view
        return view('admin.dashboard.index-content', $data);
    }
}