<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Website\Home;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\PostType;
use Illuminate\Http\Request;
use App\Models\PostViewsAnalysis;

class ServicesSingleHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $slug = null, $api = false)
    { 
        // initialize data to send to the view or client
        $data = [];
        $page_title = 'Service';
        $posts_list = Post::take(0)->get();
        $post_model = Post::service()->active()->where('post_slug', $slug)->first();
        //dd($post_model->post_id);
        $posts_list_model = Post::service()->active();

        if($post_model) {
            $page_title = $post_model->post_title;
            $tags_ids = $post_model->post_tags->pluck('tag_id')->toArray();

            if(count($tags_ids)) {
                $posts_ids = PostTag::where('tag_id', $tags_ids)
                    ->pluck('post_id')
                    ->toArray();

                $posts_list_model->whereIn('post_id', $posts_ids);
            }
        }

        $posts_list_model->orderBy('post_date', 'DESC');

        $posts_list = $posts_list_model->take(5)->get();

        $data['page_title'] = $page_title;
        $data['post_model'] = $post_model;
        $data['posts_list'] = $posts_list;

        if(isset($post_model->post_id)){
            $analysis = PostViewsAnalysis::create(
                ['post_id'=>$post_model->post_id,'visitor_ip'=>$request->ip()]
            );
        }

        // if $api is true return the json data
        if($api){
            // send data to ui
            return response()->json($data);
        }
        
        // if $api is false return the view
        return view('website.home.services-single',  $data);
    }
}