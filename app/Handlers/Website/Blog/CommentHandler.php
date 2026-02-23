<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Website\Blog;

use App\Models\PostComment;
use Illuminate\Http\Request;

class CommentHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_id = null)
    {
        // initialize data to send to the view or client
        $data = [];
        PostComment::create([
            'post_id'=>$post_id,
            'comment_author'=>user('user_id'),
            'comment_date'=>date('d-m-Y', time()),
            'comment_content'=>$request->post_comment_content,
            'comment_type'=>5
        ]);

        // if $api is false return the view
        return redirect()->back();
    }
}