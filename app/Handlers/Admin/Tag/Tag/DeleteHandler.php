<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Tag\Tag;

use App\Models\Tag;
use App\Models\TagType;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified Tags from storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $tag_id = null, $api = false)
    {
        PostTag::where('tag_id', $tag_id)->delete();
        // Find Tags from tags table and delete
        Tag::where('tag_id', $tag_id)->delete();

        if($api) {
            return response()->json(['status'=>'success', 'message'=>'Tags data deleted']);
        }

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'Tags data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'Tags data deleted']);
    }
}