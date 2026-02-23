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

class EditFormHandler
{
    /**
     * Show the form for editing the specified Socials.
     *
     * @param  int  $id
     * @param  \App\Models\Social  $socials
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, Social $socials, $id = null, $redirect = null, $hidden = [])
    {

        // initialize data to send to the view or client
        $data = [];

        // Set $hidden
        $data['hidden'] = $hidden;
        
        // Set $redirect
        $data['redirect'] = $redirect;

        // Get and assign all data from $socials to $data
        $data['model_info'] = $socials->where('id', $id)->first();
            
        // Get and assign all data from PostSocial model to $data
        $data['post_socials_list'] = PostSocial::orderBy('id', 'ASC')->get();

        // Get and assign all data from PostSocial model to $data
        $data['model_post_socials_list'] = PostSocial::where('social_id', $id)
                ->pluck('post_social_id')
                ->toArray();
        // Get and assign child child all data from Post model to $data
        $data['posts_list'] = [];

        // render and send view to user
        return view('admin.settings.socials.edit-form', $data);
    }
}