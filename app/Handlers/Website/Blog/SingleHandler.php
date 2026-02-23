<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Website\Blog;

use DB;
use Helper; 
use App\Models\Post;
use App\Models\PostViewsAnalysis;
use App\Models\Tag;
use App\Models\Location;
use Illuminate\Http\Request;
use Auth;

class SingleHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_id = null)
    {
        // initialize data to send to the view or client
        $data = [];
        $post = Post::where('post_slug', $post_id)->first();
        $categories_list = Tag::blog()->get();
        $resent_list = Post::blog()->active();
        $related_list = Post::blog();

        if($post == null) return view('error.404', ['layout'=>'website']);

        $related_list->where('post_type_id', $post->post_type_id);


        $data['post'] = $post;
        $data['categories_list'] = $categories_list;
        $data['resent_list'] = $resent_list->orderBy('post_date', 'DESC')
            ->take(3)
            ->get();
        $data['related_list'] = $related_list->take(3)->get();

        $analysis = PostViewsAnalysis::create(
            ['post_id'=>$post->post_id,'visitor_ip'=>$request->ip()]
        );

        // if $api is false return the view
        return view('website.blog.single', $data);
    }
}