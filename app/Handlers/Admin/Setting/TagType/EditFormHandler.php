<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\TagType;

use App\Models\TagType;
use App\Models\PostType;
use App\Models\PostTag;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class EditFormHandler
{
    /**
     * Show the form for editing the specified Tag Types.
     *
     * @param  int  $id
     * @param  \App\Models\TagType  $tag_types
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, TagType $tag_types, $id = null, $redirect = null, $hidden = [])
    {

        // initialize data to send to the view or client
        $data = [];

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $tag_types to $data
        $data['model_info'] = $tag_types->where('id', $id)->first();
            
        // Get and assign all data from PostType model to $data
        if(in_array('null', $hidden) && request('id')) {
            $data['post_types_list'] = PostType::where('null', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['post_types_list'] = PostType::orderBy('name', 'ASC')->get();
        }
        // Get and assign all data from PostTag model to $data
        $data['post_tags_list'] = PostTag::orderBy('id', 'ASC')->get();

        // Get and assign all data from PostTag model to $data
        $data['model_post_tags_list'] = PostTag::where('tag_type_id', $id)
                ->pluck('post_tag_id')
                ->toArray();
        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();
        // Get and assign child child all data from Tag model to $data
        $data['tags_list'] = Tag::orderBy('name', 'ASC')->get();

        // Get and assign all data from Tag model to $data
        $data['model_tags_list'] = Tag::where('tag_type_id', $id)
                ->pluck('tag_id')
                ->toArray();

        // render and send view to user
        return view('admin.settings.tag-types.edit-form', $data);
    }
}