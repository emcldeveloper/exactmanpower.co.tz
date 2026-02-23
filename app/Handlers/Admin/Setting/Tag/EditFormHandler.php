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

class EditFormHandler
{
    /**
     * Show the form for editing the specified Tags.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $tag_id = null, $api = false, $redirect = null, $hidden = [])
    {

        // initialize data to send to the view or client
        $data = [];

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $tags to $data
        $data['model_info'] = Tag::where('tag_id', $tag_id)->first();
            
        // Get and assign all data from TagType model to $data
        if(in_array('tag_id', $hidden) && request('id')) {
            $data['tag_types_list'] = TagType::where('tag_id', request('id'))->orderBy('name', 'ASC')->get();
        } else {
            $data['tag_types_list'] = TagType::orderBy('name', 'ASC')->get();
        }
        // Get and assign all data from PostTag model to $data
        $data['post_tags_list'] = PostTag::orderBy('id', 'ASC')->get();

        // Get and assign all data from PostTag model to $data
        $data['model_post_tags_list'] = PostTag::where('tag_id', $tag_id)
                ->pluck('post_tag_id')
                ->toArray();
        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();
        // Get and assign child child all data from TagType model to $data
        $data['tag_types_list'] = TagType::orderBy('name', 'ASC')->get();
        if($api) {
            return response()->json($data);
        }

        // render and send view to user
        return view('admin.setting.tags.edit-form', $data);
    }
}