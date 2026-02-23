<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Website\Home;

use App\Models\Post;
use App\Models\PostType;
use Illuminate\Http\Request;

class TeamHandler
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
        $page_title = 'Our Team';
        $team_list = Post::team()->active()->get();

        $data['page_title'] = $page_title;
        $data['team_list'] = $team_list;

        // if $api is true return the json data
        if($api){
            // send data to ui
            return response()->json($data);
        }
        
        // if $api is false return the view
        return view('website.home.team',  $data);
    }
}