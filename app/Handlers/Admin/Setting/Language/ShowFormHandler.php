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

class ShowFormHandler
{
    /**
     * Display the specified Languages.
     *
     * @param  int  $id
     * @param  \App\Models\TranslatorLanguage  $languages
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, TranslatorLanguage $languages, $id = null, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];
        $data['is_namespace'] = null;
        $sub_page = request('sub_page')? request('sub_page'): 'form';

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $languages to $data
        $data['model_info'] = $languages->where('id', $id)->first();

        

        if($sub_page === 'form' || $sub_page === 'edit') {
            $model_list = self::form($request, $languages, $id);

            $data['is_namespace'] = 'settings.';
            foreach ($model_list as $key => $value) {
                $data[$key] = $value;
            }
        }

        // render and send view to user
        $sub_view = 'show-form';
        if($sub_page == 'edit') {
            $sub_view = 'show-edit';
        }
        

        return view('admin.setting.languages.'.$sub_view, $data);
    }
    
    /**
     * Display the specified Languages.
     *
     * @param  int  $id
     * @param  \App\Models\TranslatorLanguage  $languages
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function form(Request $request, TranslatorLanguage $languages, $id = null, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from PostTag model to $data
        $data['post_tags_list'] = PostTag::orderBy('id', 'ASC')->get();

        // Get and assign all data from PostTag model to $data
        $data['model_post_tags_list'] = PostTag::where('id', $id)
                ->pluck('post_tag_id')
                ->toArray();
                
        // Get and assign child data from Post model to $data
        $data['posts_list'] = Post::orderBy('post_title', 'ASC')->get();

        // return and send data to user
        return $data;
    }
}