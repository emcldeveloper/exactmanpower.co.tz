<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Social;

use App\Models\Social;
use App\Models\PostSocial;
use App\Models\Post;
use Illuminate\Http\Request;

class CreateFormHandler
{
    /**
     * Show the form for creating a new Socials.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $redirect = null, $hidden = [])
    {
        // initialize data to send to the view or client
        $data = [];

        // Set $redirect
        $data['redirect'] = $redirect;
        
        // Set $hidden field and value
        foreach($hidden as $key => $value){
            $data[$key] = $value;
            $data['hidden'][] = $key;
        }
            
        // Get and assign all data from PostSocial model to $data
        $data['post_socials_list'] = PostSocial::orderBy('id', 'ASC')->get();

        // Get and assign all data from PostSocial model to $data
        $data['model_post_socials_list'] = [];

        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = [];

        // render and send view to user
        return view('admin.settings.socials.create-form', $data);
    }
}