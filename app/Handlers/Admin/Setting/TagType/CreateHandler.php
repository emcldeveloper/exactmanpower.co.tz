<?php
/**
 * @category Application
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\TagType;

use App\Models\TagType;
use App\Models\PostType;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class CreateHandler
{
    /**
     * Show the form for creating a new Tag Types.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request)
    {
        // initialize data to send to the view or client
        $data = [];

        // render and send view to user
        return view('admin.settings.tag-types.create', $data);
    }
}