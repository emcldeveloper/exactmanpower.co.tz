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
use App\Models\Meta;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\TagType;
use Illuminate\Http\Request;

class CreateFormHandler
{
    /**
     * Show the form for creating a new Posts.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id, $api = false, $redirect = null, $hidden = [])
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
            
        // Get and assign all data from User model to $data
        if(in_array('post_author', $hidden) && request('id')) {
            $data['users_list'] = User::where('id', request('id'))->orderBy('first_name', 'ASC')->get();
        } else {
            $data['users_list'] = User::orderBy('first_name', 'ASC')->get();
        }
            
        // Get and assign all data from PostType model to $data
        if(in_array('post_type_id', $hidden) && request('id')) {
            $data['post_types_list'] = PostType::where('id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['post_types_list'] = PostType::orderBy('name', 'ASC')->get();
        }
            
        // Get and assign all data from Post model to $data
        if(in_array('parent_post_id', $hidden) && request('id')) {
            $data['posts_list'] = Post::where('id', request('id'))->orderBy('post_title', 'ASC')->get();
        } else {
            $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();
        }
            
        // Get and assign all data from Location model to $data
        if(in_array('location_id', $hidden) && request('id')) {
            $data['locations_list'] = Location::where('id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['locations_list'] = Location::orderBy('name', 'ASC')->get();
        }

        // Get and assign all data from PostComment model to $data
        $data['model_post_comments_list'] = [];

        // Get and assign child child all data from PostComment model to $data
        $data['post_comments_list'] = PostComment::orderBy('id', 'ASC')->get();
        // Get and assign all data from PostMedia model to $data
        $data['post_medias_list'] = PostMedia::orderBy('name', 'ASC')->get();

        // Get and assign all data from PostMedia model to $data
        $data['model_post_medias_list'] = [];
        // Get and assign all data from PostMeta model to $data
        $data['post_metas_list'] = PostMeta::orderBy('id', 'ASC')->get();

        // Get and assign all data from PostMeta model to $data
        $data['model_post_metas_list'] = [];

        // Get and assign child child all data from Meta model to $data
        $data['metas_list'] = Meta::orderBy('name', 'ASC')->get();
        // Get and assign all data from PostTag model to $data
        $data['post_tags_list'] = PostTag::orderBy('id', 'ASC')->get();

        // Get and assign all data from PostTag model to $data
        $data['model_post_tags_list'] = [];

        // Get and assign child child all data from Tag model to $data
        $data['tags_list'] = Tag::orderBy('name', 'ASC')->get();

        // Get and assign child child all data from TagType model to $data
        $data['tag_types_list'] = TagType::orderBy('name', 'ASC')->get();

        // Get and assign all data from Post model to $data
        $data['model_posts_list'] = [];

        if($api) {
            return response()->json($data);
        }

        if(in_array($post_type_id, PostType::$default_types)) {
            // render and send view to user
            return view('admin.posts.'.$post_type_id.'.create-form', $data); 
        }

        // render and send view to user
        return view('admin.posts.posts.create-form', $data);
    }
}