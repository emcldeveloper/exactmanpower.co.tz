<?php
/**
 * @category Method handler
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

class UpdateHandler
{
    /**
     * Update the specified Post Types in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id = null, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = PostType::where('post_type_id', $post_type_id)->first();

        // initialize $body: data that need to be updated
        $body = [];
        if(isset($inputs->post_type_id)) $body['post_type_id'] = $inputs->post_type_id; // check if field 'post_type_id' exist from the request and then add it to $body
        if(isset($inputs->name)) $body['name'] = $inputs->name; // check if field 'name' exist from the request and then add it to $body
        
        // if there is data to update then update
        if(count($body)){
            // update post_types table
            $model->update($body);
        }
        if(is_array($request->metas_list)) {
            $updated_ids = [];
            $old_ids = Meta::where('post_type_id', $model->post_type_id)->pluck('meta_id')->toArray();
            foreach($request->metas_list as $index => $item) {
                $sub_body = [
                    'name' => $item['name'],
                    'input_type' => $item['input_type'],
                    'multiple' => $item['multiple'],
                    'options' => $item['options'],
                    'post_type_id' => $model->post_type_id,
                    'linked_type_id' => $item['linked_type_id'],
                    'linked_tag_id' => $item['linked_tag_id'],
                ];

                if(isset($item['meta_id']) && in_array($item['meta_id'], $old_ids)) {
                    $updated_ids[] = $item['meta_id'];
                    Meta::where('meta_id', $item['meta_id'])->update($sub_body);
                } else {
                    Meta::create($sub_body);
                }
            }

            foreach ($old_ids as $value) {
                if(!in_array($value, $updated_ids)){
                    Meta::where('meta_id', $value)->delete();
                }
            }
        }

        if($request->ajax() || $api) {
            $post_types_default = [ 
                ['id'=>'', 'name'=>'Select post types'], 
                ['id'=>'<new>', 'name'=>'Create new post types'], 
            ];
            $post_types_new = PostType::orderBy('name', 'ASC')->get(['post_type_id as id','name as name'])->toArray();
            $post_types_list = (array) array_merge($post_types_default, $post_types_new);
                
            return response()->json([
                "status"=>"success",
                "post_types_list"=> $post_types_list,
                "selected_id"=>$model->post_type_id
            ]);
        }



       
        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Post Types data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Post Types data updated']);
    }
}