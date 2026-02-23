<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Language;

use App\Models\TranslatorLanguage;
use App\Models\PostTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified Languages from storage.
     *
     * @param  int  $id
     * @param  \App\Models\TranslatorLanguage  $languages
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, TranslatorLanguage $languages, $id = null)
    {
        // Find Languages from languages table and delete
        $languages->where('id', $id)->delete();

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'Languages data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'Languages data deleted']);
    }
}