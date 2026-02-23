<?php

namespace App\Http\Controllers\Auth;

use DB;
use App\User;
use App\Models\Account;
use App\Models\NotificationSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $request = request();
        $request->merge(['phone'=>phone_format($request->phone)]);  
        
        $user_body = [
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'email' => isset($data['email'])? $data['email']: null,
            'phone' => isset($data['phone'])? phone_format($data['phone']): '',
            'username' => isset($data['username'])? $data['username']: null,
            'role' => User::ROLE_CUSTOMER,
            'password'=> bcrypt($data['password']),
            'remember_token' => '',
            'status' => isset($data['status'])? $data['status']: 1,
            'api_token'=>''
        ];

        DB::beginTransaction();
        try {
            $user = User::create($user_body);

            if($user){
                $account_body = [
                    'name' => $data['firstname']." ".$data['lastname'],
                    'user_id' => $user->user_id,
                    'status' => 1,
                ];
                
                $account = Account::create($account_body);
                NotificationSetting::create(['account_id'=>$account->account_id]);
                DB::commit();

                session([
                    'modal_title'=>'Thank you',
                    'modal_content'=>'Thank you for you registration, please check your phone for verification code',
                ]);
                
                return $user;
            }
        } catch (\Throwable $th) {
            // dd($th);
            DB::rollBack();
        }
        
        $this->redirectTo = '/register';
        
        return new User();
    }
}
