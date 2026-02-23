<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends \App\Http\Controllers\Controller
{
    protected $default_time = '1970-01-01 01:00:00';

    public function requestToken()
    {
        $content = [];
        
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $content['token'] =  $user->createToken(request('email'))->accessToken;
            $status = 200;
        } else {
            $content['error'] = "Unauthorised";
            $status = 401;
        }

        return response()->json($content, $status);    
    }
}
