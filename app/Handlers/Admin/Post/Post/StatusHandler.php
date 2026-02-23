<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\Post;

use Validator;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Notification;
use App\Models\PostComment;
use App\Models\PostMeta;
use App\Models\PostTag;
use Illuminate\Http\Request;

class StatusHandler
{
    /**
     * Update the specified Posts in storage.
     *
     * @param  int  $id
     * @param  \App\Models\Post  $posts
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $status_code, $id = null, $redirect = null)
    {
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // initialize model and set filters
        $model = Post::where('id', $id);

        if($status_code == 'enable') {
            $status = Post::STATUS_ACTIVE;
        } else {
            $status = Post::STATUS_INACTIVE;
        }
        
        // if there is data to update then update
        $model->update([
            'post_status' => $status
        ]);

        if($request->ajax()) {
            return [
                "status"=>"success",
                "selected_id"=>$model->post_id
            ];
        }

        $redirect = ($redirect)? $redirect: request('redirect');
        if($redirect) {
            return redirect($redirect)->with(['alert-success'=>'Posts data updated']);
        }
        
        // redirect to the edit page with success massage
        return redirect()->back()->with(['alert-success'=>'Posts data updated']);
    }
    
}