<?php
/**
 * @category Method handler
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

class ShowHandler
{
    /**
     * Display the specified Tag Types.
     *
     * @param  int  $id
     * @param  \App\Models\TagType  $tag_types
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, TagType $tag_types, $id = null)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $tag_types to $data
        $data['model_info'] = $tag_types->where('id', $id)->first();
        
        // Get and assign all data from TagType model to $data
        $data['model_list'] = TagType::get();

        // render and send view to user
        return view('admin.settings.tag-types.show', $data);
    }
}