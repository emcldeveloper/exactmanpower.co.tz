<?php

namespace App\Http\Controllers\Auth;

use User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;
    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateLogin(Request $request)
    {                         
        $request->merge([$this->username()=>phone_format($request->username)]);
        $messages = [];                                                                                                              
        $this->validate($request, [
            $this->username() => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ], $messages);
    }

    public function login(Request $request) {
        return $this->authentication($request);
    }

    public function mobileLogin(Request $request)
    {
        $credentials = $request->only('phone', 'password');
        $credentials['phone'] = phone_format($credentials['phone']);
        $remember_token = $request->has('remember_token')? true: false;

        if (Auth::attempt($credentials, $remember_token)) {
            $user = Auth::user();
            $status = 200;
            $token = $user->createToken(request('email'))->accessToken;
            $payload = [
                'token'=>$token,
                'code'=>$status
            ];

            foreach ($user->toArray() as $key => $value) {
                if(!isset($payload[$key]) && ( is_null($value) || !is_array($value))) {
                    $payload[$key] = $value;
                }
            }

            return response()->json($payload, $status); 
        }

        return response()->json([
            'code'=>401,
            'message'=>'Invalid credentials'
        ], 401);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    protected function authentication(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $request->only($this->username(), 'password');
        $credentials['status'] = User::STATUS_ACTIVE;
        $remember_token = $request->has('remember_token')? true: false;

        if (Auth::attempt($credentials, $remember_token)) {
            return $this->authenticated($request, Auth::user());
        }

        return redirect()->back()->with(['alert-error'=>'Invalid credentials']);
    }

    protected function authenticated(Request $request, $user)
    {

        $url = redirect()->intended()->getTargetUrl();

        // if($url == url($this->redirectTo)) {
        //     $this->redirectTo = '/';  

        // } else {
        //     $this->redirectTo = $url;
           
        // }

        if($request->is('api/*') || $request->is('mobile-api/*')) {
            $status = 200;
            $token = $user->createToken(request('email'))->accessToken;

            return response()->json([
                'token'=>$token,
                'status'=>$status
            ], $status);    
        }

        return view('admin.dashboard.index');
    }

    public function username()
    { 
        return 'email';
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect($this->redirectTo);
    }

    protected function performLogout(Request $request){
        Auth::logout();
        $request->session()->flush();

        $request->session()->flash('logout', true);
    }

    public function reset_password(Request $request){

        $user = User::updateOrCreate(
            ['email'=>$request->email],
            ['password'=> Hash::make($request->password)]
        );

        return redirect()->route('login')->with(['alert-success'=>'Enter your new password to login!']);
    }
}
