<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Location;

use App\Models\Location;
use App\Models\User;
use App\Models\PostType;
use App\Models\Post;
use Illuminate\Http\Request;

class CreateFormHandler
{
    /**
     * Show the form for creating a new Locations.
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
            
        // Get and assign all data from Location model to $data
        if(in_array('parent_location_id', $hidden) && request('id')) {
            $data['locations_list'] = Location::where('id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['locations_list'] = Location::orderBy('name', 'ASC')->get();
        }

        // Get and assign all data from Location model to $data
        $data['model_locations_list'] = [];

        // Get and assign all data from Post model to $data
        $data['model_posts_list'] = [];

        // Get and assign child child all data from User model to $data
        $data['users_list'] = User::orderBy('first_name', 'ASC')->get();

        // Get and assign child child all data from PostType model to $data
        $data['post_types_list'] = PostType::orderBy('name', 'ASC')->get();

        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();

        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.setting.locations.create-form', $data);
    }
}