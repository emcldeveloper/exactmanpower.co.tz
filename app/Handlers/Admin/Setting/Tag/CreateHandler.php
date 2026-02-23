<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Tag;

use App\Models\Tag;
use App\Models\TagType;
use App\Models\PostTag;
use Illuminate\Http\Request;

class CreateHandler
{
    /**
     * Show the form for creating a new Tags.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        if($api) {
            return new CreateFormHandler($request, $api);
        }

        // render and send view to user
        return view('admin.setting.tags.create', $data);
    }
}