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

class CreateFormHandler
{
    /**
     * Show the form for creating a new Post Comments.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];

        // Set $redirect
        $data['redirect'] = $redirect;
        
        // Set $hidden field and value
        foreach($hidden as $key => $value){
            $data[$key] = $value;
            $data['hidden'][] = $key;
        }
            
        // Get and assign all data from Post model to $data
        if(in_array('post_id', $hidden) && request('id')) {
            $data['posts_list'] = Post::where('id', request('id'))->orderBy('post_title', 'ASC')->get();
        } else {
            $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();
        }
            
        // Get and assign all data from PostComment model to $data
        if(in_array('parent_post_comment_id', $hidden) && request('id')) {
            $data['post_comments_list'] = PostComment::where('id', request('id'))->orderBy('id', 'ASC')->get();
        } else {
            $data['post_comments_list'] = PostComment::orderBy('id', 'ASC')->get();
        }

        // Get and assign all data from PostComment model to $data
        $data['model_post_comments_list'] = [];

        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.posts.post-comments.create-form', $data);
    }
}