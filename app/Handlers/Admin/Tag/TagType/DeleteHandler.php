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
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified Tag Types from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $tag_type_id = null, $api = false)
    {
        // Find Tag Types from tag_types table and delete
        TagType::where('tag_type_id', $tag_type_id)->delete();

        if($api) {
            return response()->json(['status'=>'success', 'message'=>'Tag Types data deleted']);
        }

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'Tag Types data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'Tag Types data deleted']);
    }
}