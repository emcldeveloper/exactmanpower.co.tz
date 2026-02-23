<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\PostType;

use App\Models\PostType;
use App\Models\Meta;
use App\Models\Post;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;

class ShowFormHandler
{
    /**
     * Display the specified Post Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id = null, $api = false, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];
        $data['is_namespace'] = null;
        $sub_page = request('sub_page')? request('sub_page'): 'form';

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $post_types to $data
        $data['model_info'] = PostType::where('post_type_id', $post_type_id)->first();

        if($sub_page == 'posts') {
            $data['sub_page_list'] = self::posts($request, $post_type_id);
        }

        if($sub_page === 'form' || $sub_page === 'edit') {
            $model_list = self::form($request, $post_type_id);

            $data['is_namespace'] = 'posts.';
            foreach ($model_list as $key => $value) {
                $data[$key] = $value;
            }
        }

        // render and send view to user
        $sub_view = 'show-form';
        if($sub_page == 'edit') {
            $sub_view = 'show-edit';
        }
        elseif($sub_page == 'posts') {
            $sub_view = 'show-posts';
        }

        if($api) {
            return response()->json($data);
        }

        return view('admin.posts.post-types.'.$sub_view, $data);
    }
    
    /**
     * Display the specified Post Types.
     *
     * @param  String  $post_type_id
     * @param  \App\Models\PostType  $post_types
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function form(Request $request, $post_type_id = null, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];

        // return and send data to user
        return $data;
    }
                
    /**
     * Display the specified Posts.
     *
     * @param  String  $post_type_id
     * @param  \App\Models\Post $posts
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function posts(Request $request, $post_type_id = null)
    {
        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');
        
        // initialize Post model
        $model = Post::where('post_type_id', $post_type_id);
        
        // check if user request for search
        if($search){
            // this do the margic for search in $model
            $model->where(function($query) use($search) {
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
        $data = (object) $model->paginate($limit);

        // return and send view to user
        return $data;
    }
}