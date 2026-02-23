<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Validator;
use App\User;
use App\Models\PasswordReset;
use App\Helpers\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function reset(Request $request) 
    {
        // initialize data to send to the view or client
        $data = [];

        return view('auth.passwords.reset-phone', $data);
    }

    public function change(Request $request) 
    {

        $data = $request->all();
        $phone = phone_format($request->phone);
        $code  = $request->verification_code;
        $data['phone'] = $phone;
        // current timestamp
        $current_time = date('Y-m-d H:i:s', time());

        // $rules is set of validation rules
        $rules = [
        	'phone' => 'required|exists:password_resets,phone',
        	'verification_code' => 'required|exists:password_resets,code',
        	'password' => 'required|min:6|confirmed',
        ];

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        
        $user = User::where('phone', $phone)->first();
        if($user) {
            $message = '';
            Schedule::sms([
                'receiver' => $phone,
                'message' => $message,
            ]);
            $reset = PasswordReset::where('phone', $phone)->where('code', $code)->first();
            if($reset) {
                $reset->delete();
                $user = User::where('phone', $phone)->first();
                $user->update(['password'=>bcrypt($request->password)]);

                Auth::login($user);
                return redirect('/');
            }
        }

        return redirect()->back()->withErrors(['alert-error'=>"Phone number or code is invalid"])->withInput();
    }
}
