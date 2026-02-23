<?php
/**
 * @category Application
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

class StoreHandler
{
    /**
     * Store a newly created Tag Types in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $rules is set of validation rules
        $rules = [
        	'post_type_id' => 'required|exists:post_types,post_type_id',
        	'name' => 'required',
        ];

        // validate request data before continue
        $validator = Validator::make($request->all(), $rules);

        // if request data is valid it continue 
        // if is invalid return back with errors
        if ($validator->fails()) { 
            if($request->ajax()) {
                return ['errors' => $validator->errors()];
            }

            return redirect()->back()->withErrors($validator)->withInput();
        } 
        
        // $body is the array of data to be save to tag_types table 
        $body = [
            'post_type_id' => $request->post_type_id,
            'name' => $request->name,
        ];

        // saving the $body data to tag_types table
        $model = TagType::create($body);
        if($model) {
            if(is_array($request->post_tags_list)) {
                for ($i = 0; $i < count($request->post_tags_list); $i++) {
                    PostTag::create([
                        'post_id' => "",
                        'tag_id' => "",
                        'tag_type_id' => $request->post_tags_list[$i],
                    ]);
                }
            }
            if(is_array($request->tags_list)) {
                for ($i = 0; $i < count($request->tags_list); $i++) {
                    Tag::create([
                        'name' => "",
                        'tag_type_id' => $request->tags_list[$i],
                    ]);
                }
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
            return redirect($redirect)->with(['alert-success'=>'Tag Types data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('settings/tag-types/edit/'.$model->id)->with(['alert-success'=>'Tag Types data saved']);
    }
}