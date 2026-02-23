<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\PostType;

use Helper;
use Validator;
use App\Models\PostType;
use App\Models\Meta;
use App\Models\Post;
use Illuminate\Http\Request;

class StoreHandler
{
    /**
     * Store a newly created Post Types in storage.
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
        
        // $body is the array of data to be save to post_types table 
        $body = [
            'name' => $request->name,
        ];

        // saving the $body data to post_types table
        $model = PostType::create($body);
        if($model) {
            if(is_array($request->metas_list)) {
                foreach($request->metas_list as $index => $item) {
                    if(isset($item['linked_tag_id'])){
                    Meta::create([
                        'name' => $item['name'],
                        'input_type' => $item['input_type'],
                        'multiple' => $item['multiple'],
                        'options' => $item['options'],
                        'post_type_id' => $model->post_type_id,
                        'linked_type_id' => $item['linked_type_id'],
                        'linked_tag_id' => $item['linked_tag_id'],
                    ]);
                    }
                }
            }
        }

        if($request->ajax() || $api) {
            $post_types_default = [ 
                ['key'=>'', 'value'=>'Select post types'], 
                ['key'=>'<new>', 'value'=>'Create new post types'], 
            ];
            $post_types_new = PostType::orderBy('name', 'ASC')->get(['post_type_id as key','name as value'])->toArray();
            $options_list = (array) array_merge($post_types_default, $post_types_new);
                
            return response()->json([
                "status"=>"success",
                "options_list"=> $options_list,
                "selected_id"=>$model->post_type_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Post Types data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/posts/post-types/edit/'.$model->post_type_id)->with(['alert-success'=>'Post Types data saved']);
    }
}