<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Tag\TagType;

use App\Models\TagType;
use App\Models\PostTag;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class ShowFormHandler
{
    /**
     * Display the specified Tag Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $tag_type_id = null, $api = false, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];
        $data['is_namespace'] = null;
        $sub_page = request('sub_page')? request('sub_page'): 'form';

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $tag_types to $data
        $data['model_info'] = TagType::where('tag_type_id', $tag_type_id)->first();

        

        if($sub_page === 'form' || $sub_page === 'edit') {
            $model_list = self::form($request, $tag_type_id);

            $data['is_namespace'] = 'tags.';
            foreach ($model_list as $key => $value) {
                $data[$key] = $value;
            }
        }

        // render and send view to user
        $sub_view = 'show-form';
        if($sub_page == 'edit') {
            $sub_view = 'show-edit';
        }
        

        if($api) {
            return response()->json($data);
        }

        return view('admin.tags.tag-types.'.$sub_view, $data);
    }
    
    /**
     * Display the specified Tag Types.
     *
     * @param  String  $tag_type_id
     * @param  \App\Models\TagType  $tag_types
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function form(Request $request, $tag_type_id = null, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];

        // return and send data to user
        return $data;
    }
}