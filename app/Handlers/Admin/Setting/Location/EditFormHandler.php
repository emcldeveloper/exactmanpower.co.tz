<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Location;

use App\Models\Location;
use App\Models\Post;
use App\Models\User;
use App\Models\PostType;
use Illuminate\Http\Request;

class EditFormHandler
{
    /**
     * Show the form for editing the specified Locations.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $location_id = null, $api = false, $redirect = null, $hidden = [])
    {

        // initialize data to send to the view or client
        $data = [];

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $locations to $data
        $data['model_info'] = Location::where('location_id', $location_id)->first();
            
        // Get and assign all data from Location model to $data
        if(in_array('location_id', $hidden) && request('id')) {
            $data['locations_list'] = Location::where('location_id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['locations_list'] = Location::orderBy('name', 'ASC')->get();
        }

        // Get and assign all data from Location model to $data
        $data['model_locations_list'] = Location::where('parent_location_id', $location_id)
                ->pluck('location_id')
                ->toArray();

        // Get and assign all data from Post model to $data
        $data['model_posts_list'] = Post::where('location_id', $location_id)
                ->pluck('post_id')
                ->toArray();
        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.setting.locations.edit-form', $data);
    }
}