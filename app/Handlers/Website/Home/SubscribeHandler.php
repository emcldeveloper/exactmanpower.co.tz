<?php
/**
 * @category Method handler
 * @author   Robert Konga <robertkonga1@gmail.com>
 * @license  http://opensource.org/licenses/BSD-3-Clause 3-clause BSD
 * @link     https://github.com/firebase/php-jwt
 */        
namespace App\Handlers\Website\Home;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribeHandler
{
    /**
     * Display a listing of the Dashboard.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function handler(Request $request, $api = false)
    {
        // initialize data to send to the view or client
        $data = [];
        $exist = Subscriber::where('email', $request->email)->first();

        if($exist) {
            Subscriber::where('email', $request->email)
                ->update([
                    'status'=>1,
                    'deactivated_at'=>null
                ]);
        } else {
            Subscriber::create([
                'query'=>$request->query,
                'email'=>$request->email,
                'notes'=>$request->notes,
                'status'=>1
            ]);
        }

        $data = [
            'modal_title'=>'Thank you',
            'modal_content'=>'Thank you to subscribe with us',
        ];

        // if $api is true return the json data
        if($api){
            // send data to ui
            return response()->json($data);
        }

        // if $api is false return the view
        return redirect()->back()->with($data);
    }
}