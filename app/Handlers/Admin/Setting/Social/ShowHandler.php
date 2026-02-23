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
use Illuminate\Http\Request;

class ShowHandler
{
    /**
     * Display the specified Socials.
     *
     * @param  int  $id
     * @param  \App\Models\Social  $socials
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, Social $socials, $id = null)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $socials to $data
        $data['model_info'] = $socials->where('id', $id)->first();
        
        // Get and assign all data from Social model to $data
        $data['model_list'] = Social::get();

        // render and send view to user
        return view('admin.settings.socials.show', $data);
    }
}