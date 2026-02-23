<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Tag;

use App\Models\Tag;
use App\Models\TagType;
use App\Models\PostTag;
use App\Models\Post;
use Illuminate\Http\Request;

class CreateFormHandler
{
    /**
     * Show the form for creating a new Tags.
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
            
        // Get and assign all data from TagType model to $data
        if(in_array('tag_type_id', $hidden) && request('id')) {
            $data['tag_types_list'] = TagType::where('id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['tag_types_list'] = TagType::orderBy('name', 'ASC')->get();
        }
        // Get and assign all data from PostTag model to $data
        $data['post_tags_list'] = PostTag::orderBy('id', 'ASC')->get();

        // Get and assign all data from PostTag model to $data
        $data['model_post_tags_list'] = [];

        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();

        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.setting.tags.create-form', $data);
    }
}