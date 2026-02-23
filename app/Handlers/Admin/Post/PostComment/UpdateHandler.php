<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\PostComment;

use Helper;
use Validator;
use App\Models\PostComment;
use App\Models\Post;
use Illuminate\Http\Request;

class UpdateHandler
{
    /**
     * Update the specified Post Comments in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_comment_id = null, $api = false, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $inputs is object of all submited inputs
        $inputs = (object) $request->all();

        // initialize model and set filters
        $model = PostComment::where('post_comment_id', $post_comment_id)->first();

        // initialize $body: data that need to be updated
        $body = [];
        if(isset($inputs->post_comment_id)) $body['post_comment_id'] = $inputs->post_comment_id; // check if field 'post_comment_id' exist from the request and then add it to $body
        if(isset($inputs->post_id)) $body['post_id'] = $inputs->post_id; // check if field 'post_id' exist from the request and then add it to $body
        if(isset($inputs->comment_author)) $body['comment_author'] = $inputs->comment_author; // check if field 'comment_author' exist from the request and then add it to $body
        if(isset($inputs->comment_date)) $body['comment_date'] = $inputs->comment_date; // check if field 'comment_date' exist from the request and then add it to $body
        if(isset($inputs->comment_content)) $body['comment_content'] = $inputs->comment_content; // check if field 'comment_content' exist from the request and then add it to $body
        if(isset($inputs->comment_type)) $body['comment_type'] = $inputs->comment_type; // check if field 'comment_type' exist from the request and then add it to $body
        if(isset($inputs->parent_post_comment_id)) $body['parent_post_comment_id'] = $inputs->parent_post_comment_id; // check if field 'parent_post_comment_id' exist from the request and then add it to $body
        if(isset($inputs->created_at)) $body['created_at'] = $inputs->created_at; // check if field 'created_at' exist from the request and then add it to $body
        $body['updated_at'] =  $current_time; // check if field 'updated_at' exist from the request and then add it to $body
        
        // if there is data to update then update
        if(count($body)){
            // update post_comments table
            $model->update($body);
        }

        if($request->ajax() || $api) {
            $post_comments_default = [ 
                ['id'=>'', 'name'=>'Select post comments'], 
                ['id'=>'<new>', 'name'=>'Create new post comments'], 
            ];
            $post_comments_new = PostComment::orderBy('id', 'ASC')->get(['post_comment_id as id','id as name'])->toArray();
            $post_comments_list = (array) array_merge($post_comments_default, $post_comments_new);
                
            return response()->json([
                "status"=>"success",
                "post_comments_list"=> $post_comments_list,
                "selected_id"=>$model->post_comment_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Post Comments data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Post Comments data updated']);
    }
}