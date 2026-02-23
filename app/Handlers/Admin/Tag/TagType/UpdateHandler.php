<?php
/**
 * @category Method handler
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

class UpdateHandler
{
    /**
     * Update the specified Tag Types in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $tag_type_id = null, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = TagType::where('tag_type_id', $tag_type_id)->first();

        // initialize $body: data that need to be updated
        $body = [];
        if(isset($inputs->tag_type_id)) $body['tag_type_id'] = $inputs->tag_type_id; // check if field 'tag_type_id' exist from the request and then add it to $body
        if(isset($inputs->name)) $body['name'] = $inputs->name; // check if field 'name' exist from the request and then add it to $body
        
        // if there is data to update then update
        if(count($body)){
            // update tag_types table
            $model->update($body);
        }
        if(is_array($request->post_tags_list)) {
            $updated_ids = [];
            $old_ids = PostTag::where('tag_type_id', $model->tag_type_id)->pluck('post_tag_id')->toArray();
            foreach($request->post_tags_list as $index => $item) {
                $sub_body = [
                    'post_id' => $item['post_id'],
                    'tag_id' => $item['tag_id'],
                    'tag_type_id' => $model->tag_type_id,
                ];

                if(isset($item['post_tag_id']) && in_array($item['post_tag_id'], $old_ids)) {
                    $updated_ids[] = $item['post_tag_id'];
                    PostTag::where('post_tag_id', $item['post_tag_id'])->update($sub_body);
                } else {
                    PostTag::create($sub_body);
                }
            }

            foreach ($old_ids as $value) {
                if(!in_array($value, $updated_ids)){
                    PostTag::where('post_tag_id', $value)->delete();
                }
            }
        }
        if(is_array($request->tags_list)) {
            $updated_ids = [];
            $old_ids = Tag::where('tag_type_id', $model->tag_type_id)->pluck('tag_id')->toArray();
            foreach($request->tags_list as $index => $item) {
                $sub_body = [
                    'name' => $item['name'],
                    'tag_type_id' => $model->tag_type_id,
                ];

                if(isset($item['tag_id']) && in_array($item['tag_id'], $old_ids)) {
                    $updated_ids[] = $item['tag_id'];
                    Tag::where('tag_id', $item['tag_id'])->update($sub_body);
                } else {
                    Tag::create($sub_body);
                }
            }

            foreach ($old_ids as $value) {
                if(!in_array($value, $updated_ids)){
                    Tag::where('tag_id', $value)->delete();
                }
            }
        }

        if($request->ajax() || $api) {
            $tag_types_default = [ 
                ['id'=>'', 'name'=>'Select tag types'], 
                ['id'=>'<new>', 'name'=>'Create new tag types'], 
            ];
            $tag_types_new = TagType::orderBy('name', 'ASC')->get(['tag_type_id as id','name as name'])->toArray();
            $tag_types_list = (array) array_merge($tag_types_default, $tag_types_new);
                
            return response()->json([
                "status"=>"success",
                "tag_types_list"=> $tag_types_list,
                "selected_id"=>$model->tag_type_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Tag Types data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Tag Types data updated']);
    }
}