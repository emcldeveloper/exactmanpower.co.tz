<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Helpers\Schedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PhoneVerifyController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function verify(Request $request) 
    {
        // initialize data to send to the view or client
        $data = [];
        
        return view('auth.phone.verify', $data);
    }

    public function store_verify(Request $request) 
    {
        // initialize data to send to the view or client
        $url = redirect()->intended()->getTargetUrl();
        if(!$url) {
            $url = '/';
        }

        $user = null;

        if($request->verification_code) {
            $user = User::where('user_id', user('user_id'))
                ->where('verification_code', $request->verification_code)
                ->first();
        }

        if($user) {
            $timestamp = date('Y-m-d H:i:s', time());
            $user->update([
                'phone_verified_at'=>$timestamp,
                'verification_code'=>null
            ]);

            return redirect($url);
        }

        return redirect()->back()->withErrors(['verification_code'=>'invalid code']); 
    }

    public function resend(Request $request) 
    {
        $user_id = user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }

        $user = User::where('user_id', $user_id)->first();
        $code = rand(1000, 9999);
        $message = config('app.name')." verification code is ". $code;
        $data = [
            'receiver' => $user->phone,
            'message' => $message,
        ];

        $user->update(['verification_code'=>$code]);

        Schedule::sms($data);

        return redirect()->back();
    }
}
