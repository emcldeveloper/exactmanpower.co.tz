<?php
/**
 * @category Application
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

class StoreHandler
{
    /**
     * Store a newly created Post Comments in storage.
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
        	'post_id' => 'required|exists:posts,post_id',
        	'comment_author' => 'required',
        	'comment_date' => 'required',
        	'comment_content' => 'required',
        	'comment_type' => 'required',
        	'parent_post_comment_id' => 'required|exists:post_comments,parent_post_comment_id',
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
        
        // $body is the array of data to be save to post_comments table 
        $body = [
            'post_id' => $request->post_id,
            'comment_author' => $request->comment_author,
            'comment_date' => $request->comment_date,
            'comment_content' => $request->comment_content,
            'comment_type' => $request->comment_type,
            'parent_post_comment_id' => $request->parent_post_comment_id,
            'created_at' => $current_time,
            'updated_at' => $current_time,
        ];

        // saving the $body data to post_comments table
        $model = PostComment::create($body);

        if($request->ajax() || $api) {
            $post_comments_default = [ 
                ['key'=>'', 'value'=>'Select post comments'], 
                ['key'=>'<new>', 'value'=>'Create new post comments'], 
            ];
            $post_comments_new = PostComment::orderBy('id', 'ASC')->get(['post_comment_id as key','id as value'])->toArray();
            $options_list = (array) array_merge($post_comments_default, $post_comments_new);
                
            return response()->json([
                "status"=>"success",
                "options_list"=> $options_list,
                "selected_id"=>$model->post_comment_id
            ]);
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Post Comments data saved']);
        }
        
        // redirect to the edit page with success massage
        return redirect('admin/posts/post-comments/edit/'.$model->post_comment_id)->with(['alert-success'=>'Post Comments data saved']);
    }
}