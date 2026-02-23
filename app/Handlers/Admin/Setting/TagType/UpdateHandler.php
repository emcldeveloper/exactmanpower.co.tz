<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\TagType;

use Validator;
use App\Models\TagType;
use App\Models\PostType;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class UpdateHandler
{
    /**
     * Update the specified Tag Types in storage.
     *
     * @param  int  $id
     * @param  \App\Models\TagType  $tag_types
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, TagType $tag_types, $id = null, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = $tag_types->where('id', $id);

        // initialize $body: data that need to be updated
        $body = [];
        
        // check if field 'post_type_id' exist from the request and then add it to $body
        if(isset($inputs->post_type_id)) $body['post_type_id'] = $inputs->post_type_id;
        
        // check if field 'name' exist from the request and then add it to $body
        if(isset($inputs->name)) $body['name'] = $inputs->name;
        
        // if there is data to update then update
        if(count($body)){
            // update tag_types table
            $model->update($body);
        }
        if(is_array($request->post_tags_list)) {
            PostTag::where('id', $id)->delete();
            for ($i = 0; $i < count($request->post_tags_list); $i++) {
                PostTag::create([
                    'post_id' => "",
                    'tag_id' => "",
                    'tag_type_id' => $request->post_tags_list[$i],
                ]);
            }
        }
        if(is_array($request->tags_list)) {
            Tag::where('id', $id)->delete();
            for ($i = 0; $i < count($request->tags_list); $i++) {
                Tag::create([
                    'name' => "",
                    'tag_type_id' => $request->tags_list[$i],
                ]);
            }
        }

        if($request->ajax()) {
            $tag_types_default = [ 
                ['id'=>'', 'name'=>'Select tag types'], 
                ['id'=>'<new>', 'name'=>'Create new tag types'], 
            ];
            $tag_types_new = TagType::orderBy('name', 'ASC')->get(['null as id','name as name'])->toArray();
            $tag_types_list = (array) array_merge($tag_types_default, $tag_types_new);
                
            return [
                "status"=>"success",
                "tag_types_list"=> $tag_types_list,
                "selected_id"=>$model->null
            ];
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Tag Types data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Tag Types data updated']);
    }
}