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

class ShowHandler
{
    /**
     * Display the specified Post Comments.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_comment_id = null, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $post_comments to $data
        $data['model_info'] = PostComment::where('post_comment_id', $post_comment_id)->first();
        
        // Get and assign all data from PostComment model to $data
        $data['model_list'] = PostComment::get();

        if($api) {
            return new ShowFormHandler($request, $post_comment_id, $api);
        }

        // render and send view to user
        return view('admin.posts.post-comments.show', $data);
    }
}