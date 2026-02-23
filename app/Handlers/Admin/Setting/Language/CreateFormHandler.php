<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Language;

use App\Models\TranslatorLanguage;
use App\Models\PostTag;
use App\Models\Post;
use Illuminate\Http\Request;

class CreateFormHandler
{
    /**
     * Show the form for creating a new Languages.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $redirect = null, $hidden = [])
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
        // Get and assign all data from PostTag model to $data
        $data['post_tags_list'] = PostTag::orderBy('id', 'ASC')->get();

        // Get and assign all data from PostTag model to $data
        $data['model_post_tags_list'] = [];

        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();

        // render and send view to user
        return view('admin.setting.languages.create-form', $data);
    }
}