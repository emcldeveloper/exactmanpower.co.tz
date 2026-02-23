<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\PostComment;

use App\Models\PostComment;
use App\Models\Post;
use Illuminate\Http\Request;

class CreateHandler
{
    /**
     * Show the form for creating a new Post Comments.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        if($api) {
            return new CreateFormHandler($request, $api);
        }

        // render and send view to user
        return view('admin.posts.post-comments.create', $data);
    }
}