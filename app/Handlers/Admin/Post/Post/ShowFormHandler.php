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
use App\Models\Meta;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\TagType;
use Illuminate\Http\Request;

class ShowFormHandler
{
    /**
     * Display the specified Posts.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id, $post_id = null, $api = false, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];
        $data['is_namespace'] = null;
        $sub_page = request('sub_page')? request('sub_page'): 'form';

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $posts to $data
        $data['model_info'] = Post::where('post_id', $post_id)->first();

        if($sub_page == 'post-comments') {
            $data['sub_page_list'] = self::post_comments($request, $post_id);
        } else if($sub_page == 'posts') {
            $data['sub_page_list'] = self::posts($request, $post_id);
        }

        if($sub_page === 'form' || $sub_page === 'edit') {
            $model_list = self::form($request, $post_id);

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
        elseif($sub_page == 'post-comments') {
            $sub_view = 'show-post-comments';
        } else if($sub_page == 'posts') {
            $sub_view = 'show-posts';
        }

        if($api) {
            return response()->json($data);
        }

        if(in_array($post_type_id, PostType::$default_types)) {
            // render and send view to user
            return view('admin.posts.'.$post_type_id.'.'.$sub_view, $data); 
        }

        return view('admin.posts.posts.'.$sub_view, $data);
    }
    
    /**
     * Display the specified Posts.
     *
     * @param  String  $post_id
     * @param  \App\Models\Post  $posts
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function form(Request $request, $post_id = null, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];

        // return and send data to user
        return $data;
    }
                
    /**
     * Display the specified Post Comments.
     *
     * @param  String  $post_id
     * @param  \App\Models\PostComment $post_comments
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function post_comments(Request $request, $post_id = null)
    {
        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');
        
        // initialize PostComment model
        $model = PostComment::where('post_id', $post_id);
        
        // check if user request for search
        if($search){
            // this do the margic for search in $model
            $model->where(function($query) use($search) {
                $query->where('id', 'LIKE', "%".$search."%") // match Id column
                    ->orWhere('post_comment_id', 'LIKE', "%".$search."%") // match Post Comment column
                    ->orWhere('post_id', 'LIKE', "%".$search."%") // match Post column
                    ->orWhere('comment_author', 'LIKE', "%".$search."%") // match Comment Author column
                    ->orWhere('comment_date', 'LIKE', "%".$search."%") // match Comment Date column
                    ->orWhere('comment_content', 'LIKE', "%".$search."%") // match Comment Content column
                    ->orWhere('comment_type', 'LIKE', "%".$search."%") // match Comment Type column
                    ->orWhere('parent_post_comment_id', 'LIKE', "%".$search."%") // match Parent Post Comment column
                    ->orWhere('created_at', 'LIKE', "%".$search."%") // match Created Time column
                    ->orWhere('updated_at', 'LIKE', "%".$search."%"); // match Updated Time column
            });
        }

        // assign model values to $data
        $data = (object) $model->paginate($limit);

        // return and send view to user
        return $data;
    }
                
    /**
     * Display the specified Posts.
     *
     * @param  String  $post_id
     * @param  \App\Models\Post $posts
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function posts(Request $request, $post_id = null)
    {
        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');
        
        // initialize Post model
        $model = Post::where('parent_post_id', $post_id);
        
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