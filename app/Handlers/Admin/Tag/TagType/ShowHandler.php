<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Tag\TagType;

use App\Models\TagType;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class ShowHandler
{
    /**
     * Display the specified Tag Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $tag_type_id = null, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $tag_types to $data
        $data['model_info'] = TagType::where('tag_type_id', $tag_type_id)->first();
        
        // Get and assign all data from TagType model to $data
        $data['model_list'] = TagType::get();

        if($api) {
            return new ShowFormHandler($request, $tag_type_id, $api);
        }

        // render and send view to user
        return view('admin.tags.tag-types.show', $data);
    }
}