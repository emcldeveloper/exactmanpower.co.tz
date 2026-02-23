<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Tag;

use App\Models\Tag;
use App\Models\TagType;
use App\Models\PostTag;
use Illuminate\Http\Request;

class ShowHandler
{
    /**
     * Display the specified Tags.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $tag_id = null, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $tags to $data
        $data['model_info'] = Tag::where('tag_id', $tag_id)->first();
        
        // Get and assign all data from Tag model to $data
        $data['model_list'] = Tag::get();

        if($api) {
            return new ShowFormHandler($request, $tag_id, $api);
        }

        // render and send view to user
        return view('admin.setting.tags.show', $data);
    }
}