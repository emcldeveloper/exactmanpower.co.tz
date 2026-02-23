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
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id, $category_id = null, $api = false)
    {

        // initialize data to send to the view or client
        $data = [];
        // $search is searched value from user interface
        $search = request('__search');
        $categories_list = Tag::blog()->get();
        // dd($categories_list);
        
        $resent_list = Post::blog()->active();
        #$posts_list = Post::blog()->active();
        $posts_list = Post::where('post_type_id',$post_type_id)->latest()->active();
        // $resent_list = (new Post())->newQuery();
        // $posts_list = (new Post())->newQuery();

        // check if user request for search
        if($search) {
            // this do the margic for search in $model
            $posts_list->where(function($query) use($search){
                $query->where('post_title', 'LIKE', "%".$search."%") // match title column
                    ->orWhere('post_content', 'LIKE', "%".$search."%");
            });
        }

        if($category_id) {
            $category_id = self::category_id($category_id);
            $posts_list->where('category_id', $category_id);
            $resent_list->where('category_id', '!=', $category_id);
        }
        
        $data['categories_list'] = $categories_list;
        $data['resent_list'] = $resent_list->take(3)->get();
        $data['blog_list'] = $posts_list->orderBy('event_date', 'DESC')
            ->paginate(4);
        // Social media goes here
            
        $shareButtons = \Share::page(

            'website.blog.index',

            'Your share text comes here',
        )->facebook()->twitter()->linkedin()->telegram()->whatsapp()->reddit();

        // if $api is false return the view
        if($post_type_id == 'gallery'){
              return view('website.blog.gallery', $data,compact('shareButtons', 'data'));
        } else {
         return view('website.blog.index', $data, compact('shareButtons', 'data'));
        }
        
    }

    private static function category_id($id = null) 
    {
        return Category::where('id', $id)->pluck('category_id')->first();
    }
}