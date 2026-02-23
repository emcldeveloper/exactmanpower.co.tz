<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Admin\Setting\Social;

use App\Models\Social;
use App\Models\PostSocial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeleteHandler
{
    /**
     * Remove the specified Socials from storage.
     *
     * @param  int  $id
     * @param  \App\Models\Social  $socials
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, Social $socials, $id = null)
    {
        // Find Socials from socials table and delete
        $socials->where('id', $id)->delete();

        if(request('redirect')){
            return redirect(request('redirect'))->with(['alert-success'=>'Socials data deleted']);
        }

        // redirect to list page with success massage
        return redirect()->back()->with(['alert-success'=>'Socials data deleted']);
    }
}