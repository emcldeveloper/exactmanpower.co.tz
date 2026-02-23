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
use App\Models\User;
use App\Models\Post;
use App\Models\Location;
use Illuminate\Http\Request;

class CreateFormHandler
{
    /**
     * Show the form for creating a new Post Types.
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
        // Get and assign all data from Meta model to $data
        $data['metas_list'] = Meta::orderBy('name', 'ASC')->get();

        // Get and assign all data from Meta model to $data
        $data['model_metas_list'] = [];

        // Get and assign all data from Post model to $data
        $data['model_posts_list'] = [];

        // Get and assign child child all data from User model to $data
        $data['users_list'] = User::orderBy('first_name', 'ASC')->get();

        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();

        // Get and assign child child all data from Location model to $data
        $data['locations_list'] = Location::orderBy('name', 'ASC')->get();

        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.posts.post-types.create-form', $data);
    }
}