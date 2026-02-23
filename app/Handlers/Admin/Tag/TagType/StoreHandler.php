<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Tag\TagType;

use Helper;
use Validator;
use App\Models\TagType;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class StoreHandler
{
    /**
     * Store a newly created Tag Types in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $rules is set of validation rules
        $rules = [
        	'name' => 'required',
        ];

        // validate request data before continue
        $validator = Validator::make($request->all(), $rules);

        // if request data is valid it continue 
        // if is invalid return back with errors
        if ($validator->fails()) { 
            if($request->ajax() || $api) {
                return response()->json(['errors' => $validator->errors()]);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        } 
        
        // $body is the array of data to be save to tag_types table 
        $body = [
            'name' => $request->name,
        ];

        // saving the $body data to tag_types table
        $model = TagType::create($body);
        if($model) {
            if(is_array($request->post_tags_list)) {
                foreach($request->post_tags_list as $index => $item) {
                    PostTag::create([
                        'post_id' => $item['post_id'],
                        'tag_id' => $item['tag_id'],
                        'tag_type_id' => $model->tag_type_id,
                    ]);
                }
            }
            if(is_array($request->tags_list)) {
                foreach($request->tags_list as $index => $item) {
                    Tag::create([
                        'name' => $item['name'],
                        'tag_type_id' => $model->tag_type_id,
                    ]);
                }
            }
        }

        if($request->ajax() || $api) {
            $tag_types_default = [ 
                ['key'=>'', 'value'=>'Select tag types'], 
                ['key'=>'<new>', 'value'=>'Create new tag types'], 
            ];
            $tag_types_new = TagType::orderBy('name', 'ASC')->get(['tag_type_id as key','name as value'])->toArray();
            $options_list = (array) array_merge($tag_types_default, $tag_types_new);
                
            return response()->json([
                "status"=>"success",
                "options_list"=> $options_list,
                "selected_id"=>$model->tag_type_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Tag Types data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/tags/tag-types/edit/'.$model->tag_type_id)->with(['alert-success'=>'Tag Types data saved']);
    }
}