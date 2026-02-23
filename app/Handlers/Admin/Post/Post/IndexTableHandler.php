<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\Post;

use App\Models\Post;
use App\Models\User;
use App\Models\PostType;
use App\Models\Location;
use App\Models\PostComment;
use App\Models\PostMedia;
use App\Models\PostMeta;
use App\Models\PostTag;
use Illuminate\Http\Request;

class IndexTableHandler
{
    /**
     * Display a listing of the Posts.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');
        
        // initialize Post model
        if(in_array($post_type_id, PostType::$default_types)) {
            $model = (new Post)->newQuery()->type($post_type_id);
        } else {
            // $model = (new Post)->newQuery()->whereNotIn('post_type_id', PostType::$default_types);
            $model = (new Post)->newQuery()->type($post_type_id);
        }
        
        // check if user request for search
        if($search){
            $search = str_replace(' ', '%', $search);
            // this do the margic for search in $model
            $model->where(function($query) use($search){
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('post_id', 'LIKE', "%".$search."%") // match Post column
                    ->orWhere('post_title', 'LIKE', "%".$search."%") // match Post Title column
                    ->orWhere('post_slug', 'LIKE', "%".$search."%") // match Post Slug column
                    ->orWhere('post_summary', 'LIKE', "%".$search."%") // match Post Summary column
                    ->orWhere('post_content', 'LIKE', "%".$search."%") // match Post Content column
                    ->orWhere('post_featured_image', 'LIKE', "%".$search."%") // match Post Featured Image column
                    ->orWhere('post_author', 'LIKE', "%".$search."%") // match Post Author column
                    ->orWhere('post_date', 'LIKE', "%".$search."%") // match Post Date column
                    ->orWhere('post_status', 'LIKE', "%".$search."%") // match Post Status column
                    ->orWhere('post_modified', 'LIKE', "%".$search."%") // match Post Modified column
                    ->orWhere('post_type_id', 'LIKE', "%".$search."%") // match Post Type column
                    ->orWhere('parent_post_id', 'LIKE', "%".$search."%") // match Parent Post column
                    ->orWhere('location_id', 'LIKE', "%".$search."%") // match Location column
                    ->orWhere('created_at', 'LIKE', "%".$search."%") // match Created Time column
                    ->orWhere('updated_at', 'LIKE', "%".$search."%") // match Updated Time column
                    ->orWhere('deleted_at', 'LIKE', "%".$search."%"); // match Deleted Time column
            });
        }
        
        // assign model values to $data
        $paginate_list = (object) $model->orderBy('updated_at','desc')->paginate($limit);
        
        if($paginate_list->count() == 0) {
            $request->merge(['page' => 1]);
            $paginate_list = (object) $model->orderBy('updated_at','desc')->paginate($limit);
        }

        $data['posts_list'] = $paginate_list;

        // if $api is true return the json data
        if($api) {
            return response()->json($data);
        }

        if(in_array($post_type_id, PostType::$default_types)) {
            // render and send view to user

            return view('admin.posts.'.$post_type_id.'.index-table', $data); 
        }

        // if $api is false return the view
        return view('admin.posts.posts.index-table', $data);
    }
}