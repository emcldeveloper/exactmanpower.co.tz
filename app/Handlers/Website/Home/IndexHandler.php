<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Website\Home;

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
    public static function handler(Request $request, $api = false)
    {

        // initialize data to send to the view or client
        $data = [];
        $categories_list = (new Tag)->newQuery();
        $sliders_list = Post::slider()->active()->get();
        $clients_list = Post::client()->active()->take(10)->get();
        $testimony_list = Post::testimony()->active()->take(10)->get();
        $team = Post::where('post_type_id','team')->paginate(3);
        //dd($team);
        $data['sliders_list'] = $sliders_list;
        $data['clients_list'] = $clients_list;
        $data['testimony_list'] = $testimony_list;
        $data['team'] = $team;

        // if $api is true return the json data
        if($api){
            $data['categories_list'] = $categories_list->get();

            return response()->json($data);
        } else {
            $data['categories_list'] = $categories_list->paginate(10);
        }

        // if $api is false return the view
        return view('website.home.index', $data);
    }
}