<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\Post;

use Auth;
use Helper;
use Validator;
use App\Models\Post;
use App\Models\User;
use App\Models\PostType;
use App\Models\Location;
use App\Models\PostComment;
use App\Models\PostMedia;
use App\Models\PostMeta;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\SupportFacades\Log;

class StoreHandler
{
    /**
     * Store a newly created Posts in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());


        // $rules is set of validation rules
        $rules = [
        	'post_title' => 'required',
        	// 'post_slug' => 'required',
        	// 'post_summary' => 'required',
        	// 'post_content' => 'required',
        	// 'post_author' => 'required',
        	// 'post_date' => 'required',
        	// 'extra_status' => 'required',
        	// 'extra_count' => 'required',
        	// 'post_status' => 'required',
        	// 'post_modified' => 'required',
        	// 'post_type_id' => 'required|exists:post_types,post_type_id',
        	// 'parent_post_id' => 'required|exists:posts,parent_post_id',
        ];

        // dd($request->all());

        if($post_type_id != 'magazine') {
            $rules['post_content'] = 'required';
        }

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
        $thumbnail_size = 960;
        $post_featured_image = Helper::save_uploaded_file($request, 'post_featured_image');
        if($post_featured_image && $post_type_id !== 'magazine' && $post_type_id !== 'publication') {
            if($post_type_id == 'slider') $thumbnail_size = 1360;
        
            Helper::add_thumbnail(public_path('uploaded/'.$post_featured_image), 460);
            Helper::add_thumbnail(public_path('uploaded/'.$post_featured_image), $thumbnail_size, null);
        }

        $icon_size = 460;
        $post_featured_icon = Helper::save_uploaded_file($request, 'post_featured_icon');
        if($post_featured_icon) {
            Helper::add_thumbnail(public_path('uploaded/'.$post_featured_icon), 160);
            Helper::add_thumbnail(public_path('uploaded/'.$post_featured_icon), $icon_size, null);
        }

        // $body is the array of data to be save to posts table 
        $post_summary = ($request->post_content)? strip_tags($request->post_content):NULL;
        $post_summary = ($post_summary)? substr($post_summary, 0, 200): null;
        
        // $body is the array of data to be save to posts table 
        $body = [
            'post_title' => $request->post_title,
            'post_summary' => $post_summary,
            'post_content' => ($request->post_content)? $request->post_content: '',
        	'post_featured_image' => $post_featured_image,
        	'post_featured_icon' => $post_featured_icon,
            'post_author' => (Auth::user())? Auth::user()->user_id: null,
            'post_date' => $current_time,
            'extra_status' => 0,
            'extra_count' => 1,
            'post_status' => 0, //I removed post_status value from Post::STATUS_ACTIVE to 0
            'post_modified' => $current_time,
            // 'post_type_id' => $request->post_type_id,
            'btn_name'=>$request->btn_name,
            'parent_post_id' => $request->parent_post_id,
            'created_at' => $current_time,
            'updated_at' => $current_time,
            'event_date' =>$request->event_date,
            'post_team_position' => $request->post_team_position,       
            'hide' => 0,
        ];

        // saving the $body data to posts table
        $model = Post::create($body);
        if($model) {
            if(is_array($request->tags_list)) {
                foreach($request->tags_list as $index => $item) {
                    if(isset($item['tag_id'])) {
                        PostTag::create([
                            'post_id' => $model->post_id,
                            'tag_id' => $item['tag_id'],
                            'tag_type_id' => $item['tag_type_id'],
                        ]);
                    }
                }
            }

            if(is_array($request->post_medias_list)) {
                foreach($request->post_medias_list as $index => $item) {
                    PostMedia::create([
                        'post_id' => $model->post_id,
                        'name' => $item['name'],
                        'original_name' => $item['original_name'],
                        'type' => $item['type'],
                        'size' => $item['size'],
                    ]);
                }
            }
            if(is_array($request->post_metas_list)) {
                foreach($request->post_metas_list as $index => $item) {
                    PostMeta::create([
                        'post_id' => $model->post_id,
                        'meta_id' => $item['meta_id'],
                        'value' => $item['value'],
                        'update_at' => $item['update_at'],
                    ]);
                }
            }
            
        }

        if($post_featured_image && $post_type_id === 'magazine') {
            ConvertPDFHandler::handler(public_path('uploaded/'.$post_featured_image));
        }

        if($request->ajax() || $api) {
            $posts_default = [ 
                ['key'=>'', 'value'=>'Select posts'], 
                ['key'=>'<new>', 'value'=>'Create new posts'], 
            ];
            $posts_new = Post::orderBy('post_title', 'ASC')->get(['post_id as key','post_title as value'])->toArray();
            $options_list = (array) array_merge($posts_default, $posts_new);
                
            return response()->json([
                "status"=>"success",
                "options_list"=> $options_list,
                "selected_id"=>$model->post_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Posts data saved']);
        }

        if(in_array($post_type_id, PostType::$default_types)) {
            // render and send view to user
            return redirect('admin/posts/'.$post_type_id.'/edit/'.$model->post_id)->with(['alert-success'=>'Posts data saved']); 
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/posts/posts/edit/'.$model->post_id)->with(['alert-success'=>'Posts data saved']);
    }
}