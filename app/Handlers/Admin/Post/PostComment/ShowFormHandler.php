<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\PostComment;

use App\Models\PostComment;
use App\Models\Post;
use Illuminate\Http\Request;

class ShowFormHandler
{
    /**
     * Display the specified Post Comments.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_comment_id = null, $api = false, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];
        $data['is_namespace'] = null;
        $sub_page = request('sub_page')? request('sub_page'): 'form';

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $post_comments to $data
        $data['model_info'] = PostComment::where('post_comment_id', $post_comment_id)->first();

        if($sub_page == 'post-comments') {
            $data['sub_page_list'] = self::post_comments($request, $post_comment_id);
        }

        if($sub_page === 'form' || $sub_page === 'edit') {
            $model_list = self::form($request, $post_comment_id);

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
        }

        if($api) {
            return response()->json($data);
        }

        return view('admin.posts.post-comments.'.$sub_view, $data);
    }
    
    /**
     * Display the specified Post Comments.
     *
     * @param  String  $post_comment_id
     * @param  \App\Models\PostComment  $post_comments
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function form(Request $request, $post_comment_id = null, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];

        // return and send data to user
        return $data;
    }
                
    /**
     * Display the specified Post Comments.
     *
     * @param  String  $post_comment_id
     * @param  \App\Models\PostComment $post_comments
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function post_comments(Request $request, $post_comment_id = null)
    {
        // $limit is the number of items per page (in pagination)
        $limit = (int) ($request->limit)? (int) $request->limit: 10;

        // $search is searched value from user interface
        $search = request('__search');
        
        // initialize PostComment model
        $model = PostComment::where('parent_post_comment_id', $post_comment_id);
        
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
}