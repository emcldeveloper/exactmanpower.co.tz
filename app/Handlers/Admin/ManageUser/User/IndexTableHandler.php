<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\ManageUser\User;

use App\Models\User;
use App\Models\Post;
use App\Models\UserLog;
use Illuminate\Http\Request;

class IndexTableHandler
{
    /**
     * Display a listing of the Users.
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
        
        // initialize User model
        $model = (new User)->newQuery();
        
        // check if user request for search
        if($search){
            $search = str_replace(' ', '%', $search);
            // this do the margic for search in $model
            $model->where(function($query) use($search){
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('user_id', 'LIKE', "%".$search."%") // match User column
                    ->orWhere('first_name', 'LIKE', "%".$search."%") // match First Name column
                    ->orWhere('second_name', 'LIKE', "%".$search."%") // match Second Name column
                    ->orWhere('last_name', 'LIKE', "%".$search."%") // match Last Name column
                    ->orWhere('username', 'LIKE', "%".$search."%") // match Username column
                    ->orWhere('social_name', 'LIKE', "%".$search."%") // match Social Name column
                    ->orWhere('social_id', 'LIKE', "%".$search."%") // match Social column
                    ->orWhere('email', 'LIKE', "%".$search."%") // match Email column
                    ->orWhere('phone', 'LIKE', "%".$search."%") // match Phone column
                    ->orWhere('password', 'LIKE', "%".$search."%") // match Password column
                    ->orWhere('role', 'LIKE', "%".$search."%") // match Role column
                    ->orWhere('profile_url', 'LIKE', "%".$search."%") // match Profile Url column
                    ->orWhere('token', 'LIKE', "%".$search."%") // match Token column
                    ->orWhere('remember_token', 'LIKE', "%".$search."%") // match Remember Token column
                    ->orWhere('status', 'LIKE', "%".$search."%") // match Status column
                    ->orWhere('created_at', 'LIKE', "%".$search."%") // match Created Time column
                    ->orWhere('updated_at', 'LIKE', "%".$search."%") // match Updated Time column
                    ->orWhere('deleted_at', 'LIKE', "%".$search."%") // match Deleted Time column
                    ->orWhere('email_verified_at', 'LIKE', "%".$search."%"); // match Email Verified Time column
            });
        }
        
        // assign model values to $data
        $paginate_list = (object) $model->paginate($limit);

        if($paginate_list->count() == 0) {
            $request->merge(['page' => 1]);
            $paginate_list = (object) $model->paginate($limit);
        }

        $data['users_list'] = $paginate_list;

        // if $api is true return the json data
        if($api) {
            return response()->json($data);
        }

        // if $api is false return the view
        return view('admin.manage-users.users.index-table', $data);
    }
}