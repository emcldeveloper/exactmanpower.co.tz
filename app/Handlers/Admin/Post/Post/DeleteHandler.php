<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\Post;

use App\Models\Post;
use App\Models\User;
use App\Models\PostType;
use App\Models\Location;
use App\Models\PostComment;
use App\Models\PostMedia;
use App\Models\PostMeta;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified Posts from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id, $post_id = null, $api = false)
    {
        $post = Post::where('post_id', $post_id)->first();

        // Find post_featured_image file
        self::delete_post_featured_image($post);

        // Find Posts from posts table and delete
        if($post) {
            $post->delete();
        }
        

        if($api) {
            return response()->json(['status'=>'success', 'message'=>'Posts data deleted']);
        }

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'Posts data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'Posts data deleted']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post $posts
     * @return \Illuminate\Http\Response
     */
    public static function delete_post_featured_image($post = null)
    {
        if($post){
            $filename = public_path('uploaded/'.$post->post_featured_image);

            if(File::exists($filename)){
                File::delete($filename);
            }
        }
    }
}