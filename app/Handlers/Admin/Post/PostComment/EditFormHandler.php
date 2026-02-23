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

class EditFormHandler
{
    /**
     * Show the form for editing the specified Post Comments.
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

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $post_comments to $data
        $data['model_info'] = PostComment::where('post_comment_id', $post_comment_id)->first();
            
        // Get and assign all data from Post model to $data
        if(in_array('post_comment_id', $hidden) && request('id')) {
            $data['posts_list'] = Post::where('post_comment_id', request('id'))->orderBy('post_title', 'ASC')->get();
        } else {
            $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();
        }
            
        // Get and assign all data from PostComment model to $data
        if(in_array('post_comment_id', $hidden) && request('id')) {
            $data['post_comments_list'] = PostComment::where('post_comment_id', request('id'))->orderBy('id', 'ASC')->get();
        } else {
            $data['post_comments_list'] = PostComment::orderBy('id', 'ASC')->get();
        }

        // Get and assign all data from PostComment model to $data
        $data['model_post_comments_list'] = PostComment::where('parent_post_comment_id', $post_comment_id)
                ->pluck('post_comment_id')
                ->toArray();
        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();
        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.posts.post-comments.edit-form', $data);
    }
}