<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Tag;

use Helper;
use Validator;
use App\Models\Tag;
use App\Models\TagType;
use App\Models\PostTag;
use Illuminate\Http\Request;

class UpdateHandler
{
    /**
     * Update the specified Tags in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $tag_id = null, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = Tag::where('tag_id', $tag_id)->first();

        // initialize $body: data that need to be updated
        $body = [];
        if(isset($inputs->tag_id)) $body['tag_id'] = $inputs->tag_id; // check if field 'tag_id' exist from the request and then add it to $body
        if(isset($inputs->name)) $body['name'] = $inputs->name; // check if field 'name' exist from the request and then add it to $body
        if(isset($inputs->tag_type_id)) $body['tag_type_id'] = $inputs->tag_type_id; // check if field 'tag_type_id' exist from the request and then add it to $body
        
        // if there is data to update then update
        if(count($body)){
            // update tags table
            $model->update($body);
        }
        if(is_array($request->post_tags_list)) {
            $updated_ids = [];
            $old_ids = PostTag::where('tag_id', $model->tag_id)->pluck('post_tag_id')->toArray();
            foreach($request->post_tags_list as $index => $item) {
                $sub_body = [
                    'post_id' => $item['post_id'],
                    'tag_id' => $model->tag_id,
                    'tag_type_id' => $item['tag_type_id'],
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

        if($request->ajax() || $api) {
            $tags_default = [ 
                ['id'=>'', 'name'=>'Select tags'], 
                ['id'=>'<new>', 'name'=>'Create new tags'], 
            ];
            $tags_new = Tag::orderBy('name', 'ASC')->get(['tag_id as id','name as name'])->toArray();
            $tags_list = (array) array_merge($tags_default, $tags_new);
                
            return response()->json([
                "status"=>"success",
                "tags_list"=> $tags_list,
                "selected_id"=>$model->tag_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Tags data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Tags data updated']);
    }
}