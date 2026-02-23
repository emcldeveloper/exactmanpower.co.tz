<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Tag\Tag;

use Helper;
use Validator;
use App\Models\Tag;
use App\Models\TagType;
use App\Models\PostTag;
use Illuminate\Http\Request;

class StoreHandler
{
    /**
     * Store a newly created Tags in storage.
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
        	'tag_type_id' => 'required|exists:tag_types,tag_type_id',
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
        
        // $body is the array of data to be save to tags table 
        $body = [
            'name' => $request->name,
            'tag_type_id' => $request->tag_type_id,
        ];

        // saving the $body data to tags table
        $model = Tag::create($body);
        if($model) {
            if(is_array($request->post_tags_list)) {
                foreach($request->post_tags_list as $index => $item) {
                    PostTag::create([
                        'post_id' => $item['post_id'],
                        'tag_id' => $model->tag_id,
                        'tag_type_id' => $item['tag_type_id'],
                    ]);
                }
            }
        }

        if($request->ajax() || $api) {
            $tags_default = [ 
                ['key'=>'', 'value'=>'Select tags'], 
                ['key'=>'<new>', 'value'=>'Create new tags'], 
            ];
            $tags_new = Tag::orderBy('name', 'ASC')->get(['tag_id as key','name as value'])->toArray();
            $options_list = (array) array_merge($tags_default, $tags_new);
                
            return response()->json([
                "status"=>"success",
                "options_list"=> $options_list,
                "selected_id"=>$model->tag_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Tags data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/tags/tags/edit/'.$model->tag_id)->with(['alert-success'=>'Tags data saved']);
    }
}