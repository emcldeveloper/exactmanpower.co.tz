<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Post\PostType;

use App\Models\PostType;
use App\Models\Meta;
use App\Models\Post;
use Illuminate\Http\Request;

class ShowHandler
{
    /**
     * Display the specified Post Types.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $post_type_id = null, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];

        // Get and assign all data from $post_types to $data
        $data['model_info'] = PostType::where('post_type_id', $post_type_id)->first();
        
        // Get and assign all data from PostType model to $data
        $data['model_list'] = PostType::get();

        if($api) {
            return new ShowFormHandler($request, $post_type_id, $api);
        }

        // render and send view to user
        return view('admin.posts.post-types.show', $data);
    }
}