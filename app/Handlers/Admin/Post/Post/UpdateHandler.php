<?php
/**
 * @category Method handler
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

class UpdateHandler
{
    /**
     * Update the specified Posts in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function comment(Request $request, $post_type_id, $post_id = null, $api = false, $redirect = null){

        // Save commentor's information
        $check = User::where('email',$request->email)->first();
        if(isset($check->email)){
            $commentor = $check;
        } else{
            $check = User::where('username',$request->username)->first();
            if(isset($check->username)){
               $commentor = $check; 
            } else {
                $commentor = User::updateOrCreate(
                    ['email'=>$request->email, 'username'=>$request->username,'first_name'=>'Commenter','second_name'=>'Commenter','last_name'=>'Commenter','password'=>$request->_token]
                );
            }
        }
 
        $save_comment = PostComment::create(
            ['post_id'=>$post_id,'user_id'=>$commentor->user_id,'comment_content'=>$request->post_comment,'post_type_id'=>$post_type_id]
        );
        return redirect()->back()->with(['alert-success'=>'Comment added successful!']);
    }

    public static function handler(Request $request, $post_type_id, $post_id = null, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = Post::where('post_id', $post_id)->first();
        // dd();
        // dd($request->all());
        if($request->upload == 'upload'){
            Post::updateOrCreate(
                ['id'=>$model->id],
                ['post_status'=>$request->post_status]
            );
            return redirect()->back()->with(['alert-success'=>'Posts uploaded successful']);
        }

        // initialize $body: data that need to be updated
        $body = [];
        if(isset($inputs->post_id))
         $body['post_id'] = $inputs->post_id; // check if field 'post_id' exist from the request and then add it to $body
        if(isset($inputs->post_title))
         $body['post_title'] = $inputs->post_title; // check if field 'post_title' exist from the request and then add it to $body
        if(isset($inputs->post_slug)) $body['post_slug'] = $inputs->post_slug; // check if field 'post_slug' exist from the request and then add it to $body
        if(isset($inputs->post_summary)) $body['post_summary'] = $inputs->post_summary; // check if field 'post_summary' exist from the request and then add it to $body
        if(isset($inputs->post_content)) $body['post_content'] = $inputs->post_content; // check if field 'post_content' exist from the request and then add it to $body
        if(isset($inputs->post_author)) $body['post_author'] = $inputs->post_author; // check if field 'post_author' exist from the request and then add it to $body
        if(isset($inputs->post_date)) $body['post_date'] = $inputs->post_date; // check if field 'post_date' exist from the request and then add it to $body
        if(isset($inputs->post_status)) $body['post_status'] = $inputs->post_status; // check if field 'post_status' exist from the request and then add it to $body
        if(isset($inputs->post_modified)) $body['post_modified'] = $inputs->post_modified; // check if field 'post_modified' exist from the request and then add it to $body
        if(isset($inputs->post_type_id)) $body['post_type_id'] = $inputs->post_type_id; // check if field 'post_type_id' exist from the request and then add it to $body
        if(isset($inputs->parent_post_id)) $body['parent_post_id'] = $inputs->parent_post_id; // check if field 'parent_post_id' exist from the request and then add it to $body
        if(isset($inputs->location_id)) $body['location_id'] = $inputs->location_id; // check if field 'location_id' exist from the request and then add it to $body
        if(isset($inputs->created_at)) $body['created_at'] = $inputs->created_at; // check if field 'created_at' exist from the request and then add it to $body
        $body['updated_at'] =  $current_time; // check if field 'updated_at' exist from the request and then add it to $body
        if(isset($inputs->deleted_at)) $body['deleted_at'] = $inputs->deleted_at; // check if field 'deleted_at' exist from the request and then add it to $body
        if(isset($inputs->event_date)) $body['event_date'] = $inputs->event_date;  // check if field 'deleted_at' exist from the request and then add it to $body
        if(isset($inputs->post_team_position)) $body['post_team_position'] = $inputs->post_team_position;  // check if field 'deleted_at' exist from the request and then add it to $body

        $post_featured_image = Helper::save_uploaded_file($request, 'post_featured_image');

        if($post_featured_image && $post_type_id !== 'magazine' && $post_type_id !== 'publication') {
            $thumbnail_size = 960;
            if($post_type_id == 'slider') $thumbnail_size = 1360;
            
            Helper::add_thumbnail(public_path('uploaded/'.$post_featured_image), 460);
            Helper::add_thumbnail(public_path('uploaded/'.$post_featured_image), $thumbnail_size, null);
        }

        if($post_featured_image) {
            $body['post_featured_image'] = $post_featured_image;
        }

        $post_featured_icon = Helper::save_uploaded_file($request, 'post_featured_icon');

        if($post_featured_icon) {
            $icon_size = 460;
            Helper::add_thumbnail(public_path('uploaded/'.$post_featured_icon), 160);
            Helper::add_thumbnail(public_path('uploaded/'.$post_featured_icon), $icon_size, null);
        }

        if($post_featured_icon) {
            $body['post_featured_icon'] = $post_featured_icon;
        }
        // dd($body);
        // if there is data to update then update
        if(count($body)){
            // update posts table
            // dd($model);
            $model->update($body);
        }
        if(is_array($request->post_medias_list)) {
            $updated_ids = [];
            $old_ids = PostMedia::where('post_id', $model->post_id)->pluck('post_media_id')->toArray();
            foreach($request->post_medias_list as $index => $item) {
                $sub_body = [
                    'post_id' => $model->post_id,
                    'name' => $item['name'],
                    'original_name' => $item['original_name'],
                    'type' => $item['type'],
                    'size' => $item['size'],
                ];

                if(isset($item['post_media_id']) && in_array($item['post_media_id'], $old_ids)) {
                    $updated_ids[] = $item['post_media_id'];
                    PostMedia::where('post_media_id', $item['post_media_id'])->update($sub_body);
                } else {
                    PostMedia::create($sub_body);
                }
            }

            foreach ($old_ids as $value) {
                if(!in_array($value, $updated_ids)){
                    PostMedia::where('post_media_id', $value)->delete();
                }
            }
        }
        if(is_array($request->post_metas_list)) {
            $updated_ids = [];
            $old_ids = PostMeta::where('post_id', $model->post_id)->pluck('post_meta_id')->toArray();
            foreach($request->post_metas_list as $index => $item) {
                $sub_body = [
                    'post_id' => $model->post_id,
                    'meta_id' => $item['meta_id'],
                    'value' => $item['value'],
                    'update_at' => $item['update_at'],
                ];

                if(isset($item['post_meta_id']) && in_array($item['post_meta_id'], $old_ids)) {
                    $updated_ids[] = $item['post_meta_id'];
                    PostMeta::where('post_meta_id', $item['post_meta_id'])->update($sub_body);
                } else {
                    PostMeta::create($sub_body);
                }
            }

            foreach ($old_ids as $value) {
                if(!in_array($value, $updated_ids)){
                    PostMeta::where('post_meta_id', $value)->delete();
                }
            }
        }
        if(is_array($request->tags_list)) {
            PostTag::where('post_id', $model->post_id)->delete();
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

        if($post_featured_image && $post_type_id === 'magazine') {
            ConvertPDFHandler::handler(public_path('uploaded/'.$post_featured_image));
        }

        if($request->ajax() || $api) {
            $posts_default = [ 
                ['id'=>'', 'name'=>'Select posts'], 
                ['id'=>'<new>', 'name'=>'Create new posts'], 
            ];
            $posts_new = Post::orderBy('post_title', 'ASC')->get(['post_id as id','post_title as name'])->toArray();
            $posts_list = (array) array_merge($posts_default, $posts_new);
                
            return response()->json([
                "status"=>"success",
                "posts_list"=> $posts_list,
                "selected_id"=>$model->post_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Posts data updated']);
        }


        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Posts data updated']);
    }
}