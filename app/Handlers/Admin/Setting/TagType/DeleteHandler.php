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
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified Tag Types from storage.
     *
     * @param  int  $id
     * @param  \App\Models\TagType  $tag_types
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, TagType $tag_types, $id = null)
    {
        // Find Tag Types from tag_types table and delete
        $tag_types->where('id', $id)->delete();

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'Tag Types data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'Tag Types data deleted']);
    }
}