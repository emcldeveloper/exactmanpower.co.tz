<?php
/**
 * @category Application
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

class CreateHandler
{
    /**
     * Show the form for creating a new Posts.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        if($api) {
            return new CreateFormHandler($request, $api);
        }

        if(in_array($post_type_id, PostType::$default_types)) {
            // render and send view to user
            return view('admin.posts.'.$post_type_id.'.create', $data); 
        }

        // render and send view to user
        return view('admin.posts.posts.create', $data);
    }
}