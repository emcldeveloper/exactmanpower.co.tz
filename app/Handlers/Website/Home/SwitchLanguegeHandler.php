<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Website\Home;

use Illuminate\Http\Request;

class SwitchLanguegeHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $lang = 'sw', $api = false)
    {
        session(['current_locale'=> $lang]);

        // if $api is true return the json data
        if($api){
            // send data to ui
            return response()->json(['status'=>'success']);
        }

        return redirect()->back();
    }
}