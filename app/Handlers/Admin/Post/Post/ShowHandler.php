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

class ShowHandler
{
    /**
     * Display the specified Posts.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id, $post_id = null, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $posts to $data
        $data['model_info'] = Post::where('post_id', $post_id)->first();
        
        // Get and assign all data from Post model to $data
        $data['model_list'] = Post::get();

        if($api) {
            return new ShowFormHandler($request, $post_id, $api);
        }

        if(in_array($post_type_id, PostType::$default_types)) {
            // render and send view to user
            return view('admin.posts.'.$post_type_id.'.show', $data); 
        }

        // render and send view to user
        return view('admin.posts.posts.show', $data);
    }
}