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

class EditFormHandler
{
    /**
     * Show the form for editing the specified Post Types.
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

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $post_types to $data
        $data['model_info'] = PostType::where('post_type_id', $post_type_id)->first();
        // Get and assign all data from Meta model to $data
        $data['metas_list'] = Meta::orderBy('name', 'ASC')->get();

        // Get and assign all data from Meta model to $data
        $data['model_metas_list'] = Meta::where('post_type_id', $post_type_id)
                ->pluck('meta_id')
                ->toArray();

        // Get and assign all data from Post model to $data
        $data['model_posts_list'] = Post::where('post_type_id', $post_type_id)
                ->pluck('post_id')
                ->toArray();
        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.posts.post-types.edit-form', $data);
    }
}