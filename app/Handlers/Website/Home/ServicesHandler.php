<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Website\Home;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\PostType;
use Illuminate\Http\Request;

class ServicesHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];
        $page_title = 'Services';

        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 9;

        // $search is searched value from user interface
        $search = request('__search');

        $model = Post::service()->active();

        // check if user request for search
        if($search){
            $search = str_replace(' ', '%', $search);
            // this do the margic for search in $model
            $model->where(function($query) use($search){
                $query->where('post_title', 'LIKE', "%".$search."%")
                    ->orWhere('post_slug', 'LIKE', "%".$search."%") 
                    ->orWhere('post_summary', 'LIKE', "%".$search."%") 
                    ->orWhere('post_content', 'LIKE', "%".$search."%"); 
            });
        }
        //DESC
        $arraange = 'ASC';
        $model->orderBy('post_date', $arraange);
        
        // assign model values to $data
        $paginate_list = (object) $model->paginate($limit);

        if($paginate_list->count() == 0) {
            $request->merge(['page' => 1]);
            $paginate_list = (object) $model->paginate($limit);
        }

        $data['page_title'] = $page_title;
        $data['posts_list'] = $paginate_list;

        
        // if $api is true return the json data
        if($api){
            // send data to ui
            return response()->json($data);
        }
        
        // if $api is false return the view
        // dd($data);
        return view('website.home.services',  $data);
    }
}