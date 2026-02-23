<?php

namespace App\Http\Controllers\Auth;

use DB;
use Auth;
use Helper;
use VerifyFreelancer;
use App\Models\Account;
use App\Models\User;
use App\Models\Location;
use App\Models\AccountUser;
use App\Models\AccountEducation;
use App\Models\AccountReferee;
use App\Models\Post;
use App\Models\Order;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\ServiceKeyword;
use App\Models\Log;
use App\Models\NotificationSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterFreelancerController extends Controller
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
        // $this->middleware('guest');
    }

    public function credentials(Request $request, $user_id = null) 
    {
        // initialize data to send to the view or client
        $data = [];
        $model = null;
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }

        if($user_id) {
            $model = User::where('user_id', $user_id)->first();
        }
        $data['model'] = $model;

        return view('auth.register-freelancer.credentials', $data);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function store_credentials(Request $request, $user_id = null)
    {
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }

        $request->merge(['phone'=>phone_format($request->phone)]);  
        $data = $request->all();
        $user = User::where('user_id', $user_id)->first();
        $rules = [
            'firstname' => ['required', 'string', 'max:48'],
            'lastname' => ['required', 'string', 'max:48'],
            'freelancer_type' => ['required'],
            'phone' => ['required', 'numeric', 'digits_between:10,12', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
        ];

        if($request->freelancer_type == '1') {
            $rules['account_name'] = ['required', 'string', 'max:148'];
        }

        if($user_id) {
            $rules['phone'] = ['required', 'string', 'max:13', 'unique:users,phone,'.$user_id.',user_id'];
            unset($rules['password']);
        }

        $messages = [
            "regex" => "Password is weak",
        ];

        $validator = Validator::make($data, $rules, $messages);
        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_body = [
            'first_name' => $data['firstname'],
            'last_name' => $data['lastname'],
            'email' => isset($data['email'])? $data['email']: null,
            'phone' => isset($data['phone'])? phone_format($data['phone']): null,
            'username' => isset($data['username'])? $data['username']: null,
            'role' => User::ROLE_FREELANCER,
            'remember_token' => '',
            'status' => isset($data['status'])? $data['status']: User::STATUS_ACTIVE,
            'freelancer_status' => User::FREELANCER_STATUS_INCOMPLETE,
            'freelancer_type' => isset($data['freelancer_type'])? $data['freelancer_type']: User::TYPE_FREELANCER,
            'api_token' => ''
        ];

        DB::beginTransaction();
        try {
            if($user) {
                $user->update($user_body);
            } else {
                if($data['password'] && $data['password'] != '') {
                    $user_body['password'] = bcrypt($data['password']);
                }
                $user = User::create($user_body);

                session([
                    'modal_title'=>'Thank you',
                    'modal_content'=>'Thank you for you registration, please check you phone for verification code',
                ]);
            }

            if($user){
                $account = Account::where('user_id', $user->user_id)->first();
                $account_name = ($request->freelancer_type == '1')? 
                    $request->account_name: 
                    $data['firstname']." ".$data['lastname'];

                $account_body = [
                    'name' => $account_name,
                    'email' => isset($data['email'])? $data['email']: null,
                    'phone' => isset($data['phone'])? phone_format($data['phone']): null,
                    'status' => 1,
                ];
                if($account) {
                    $account->update($account_body);
                } else {
                    $account_body['user_id'] = $user->user_id;
                    $account = Account::create($account_body);
                    NotificationSetting::create(['account_id'=>$account->account_id]);
                }

                DB::commit();

                if($user) {
                    Auth::login($user);

                    $controller = new PhoneVerifyController();
                    $controller->resend($request);
                }
                
                return redirect('register/freelancer/services/'.$user->user_id);
            } 
        } catch (\Throwable $th) {
            DB::rollBack();
            // dd($th);
        }

        return redirect()->back()->withErrors(['alert'=>"No registared"])->withInput();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function services(Request $request, $user_id = null)
    {
        $data = [];
        $model = null;
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }

        if($user_id) {
            $model = User::where('user_id', $user_id)->first();
        }

       
        $categories_list = ServiceType::with(['keywords'])->get();
        
        $services_list = Service::with(['service_keywords'])->where('service_author', $user_id)->get();
        // dd('robert');
        $data['model'] = $model;
        $data['categories_list'] = $categories_list;
        $data['services_list'] = $services_list;

        Account::createAccount();

        if($request->is('account/*')) {
            return view('accounts.accounts.general', $data);
        } elseif($request->is('admin/*')) {
            return view('admin.manage-users.users.general', $data);
        }

        return view('auth.register-freelancer.services', $data); 
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function store_services(Request $request, $user_id = null)
    {
    
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }
        $data = $request->all();
        // dd($data);

        if($request->submit == 'continue') {
            $rules = [];
        } else {
            $rules = [
                'services_list.*.service_type_id' => ['required', 'exists:service_types,service_type_id'],
                'services_list.*.started_since' => ['required'],
                // 'services_list.*.price' => ['required', 'numeric'],
                // 'services_list.*.service_content' => ['required'],
                'services_list.*.keywords' => ['required'],
            ];
        }
        
        $messages = [
            'services_list.*.service_type_id.required' => 'You must select skill.',
            'services_list.*.started_since.required' => 'Tell us when did you start.',
            'services_list.*.price.required' => 'How much will you change?.',
            'services_list.*.service_content.required' => 'Tell us something.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(is_array($request->services_list)) {
            foreach ($request->services_list as $elem) {
                
                $body = [
                    'service_status' => Service::STATUS_DRAFT,
                    'service_type_id' => $elem['service_type_id'],
                    'started_since' => $elem['started_since'],
                    'price' => isset($elem['price'])? $elem['price']: null,
                    'service_content' => isset($elem['service_content'])? $elem['service_content']: "",
                ];

                $service = Service::where('service_author', $user_id)
                    ->where('service_type_id', $elem['service_type_id'])
                    ->first();

                if($service) {
                    Service::where('service_author', $user_id)
                        ->where('service_type_id', $elem['service_type_id'])
                        ->update($body);
                } else {
                    $body['service_title'] = ServiceType::where('service_type_id', $elem['service_type_id'])
                        ->pluck('name')
                        ->first();

                    $body['service_author'] = $user_id;

                    // dd($body);
                    $service = Service::create($body);
                }

                if($service && isset($elem['keywords']) && is_array($elem['keywords'])) {
                    $keywords_ids = [];
                    foreach ($elem['keywords'] as $item) {
                        if(isset($item['id'])) {
                            $keywords_ids[] = $item['id'];
                        }
                    }

                    ServiceKeyword::where('service_id', $service->service_id)
                            ->whereNotIn('service_type_keyword_id', $keywords_ids)
                            ->delete();

                    // dd($elem['keywords']);
                    foreach ($elem['keywords'] as $item) {
                        
                        # code... ServiceKeyword
                        if(isset($item['id'])) {
                            $exists = ServiceKeyword::where('service_id', $service->service_id)
                                ->where('service_type_keyword_id', $item['id'])
                                ->first();

                            if($exists) {
                                $exists->update(['price'=>$item['price']]);
                            } else {
                                ServiceKeyword::create([
                                    'service_type_keyword_id'=>$item['id'],
                                    'service_id'=>$service->service_id,
                                    'price'=>$item['price']
                                ]);
                            }
                            
                        }
                    }
                }
            }
        }

        $this->checkFreelancerStatus($request, $user_id);

        if($request->is('account/*')) {
            return redirect()->back();
        } elseif($request->is('admin/*')) {
            return redirect('admin/manage-users/freelancer/info/'.$user_id); 
        }

        return redirect('register/freelancer/info/'.$user_id);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function info(Request $request, $user_id = null)
    {
        $data = [];
        $model = null;
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }
        $data['locations_list'] = Location::with(['location.location.location'])->get();
        if($user_id) {
            Account::createAccount();
            $model = Account::where('user_id', $user_id)->first();
        }
        $data['model'] = $model;

        if($request->is('account/*')) {
            return view('accounts.accounts.general', $data);
        } elseif($request->is('admin/*')) {
            return view('admin.manage-users.users.general', $data);
        }

        return view('auth.register-freelancer.info', $data); 
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function store_info(Request $request, $user_id = null)
    {
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }
        $data = $request->all();

        if($request->submit == 'continue') {
            $rules = [];
        } else {
            $rules = [
                'village_street' => ['required', 'string'],
            ];
    
            if(!$request->set_location_id) {
                $rules['location_id'] = ['required', 'exists:locations,location_id'];
            } else {
                $data['location_id'] = $request->set_location_id;
            }
    
            if(!$request->local_government_letter_uploaded) {
                $rules['local_government_letter'] = ['required', 'file'];
            }
        }

        if(!Auth::user()->is_freelancer()) {
            $rules = [];
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $local_government_letter = Helper::save_uploaded_file($request, 'local_government_letter');

        $account_body = [
            'address' => $data['address'],
            'location_id' => $data['location_id'],
            'village_street' => isset($data['village_street'])? $data['village_street']: null,
            'house_number' => isset($data['house_number'])? $data['house_number']: null,
        ];

        if($local_government_letter) {
            $account_body['local_government_letter'] = $local_government_letter;
        }

        Account::where('user_id', $user_id)->update($account_body);

        $this->checkFreelancerStatus($request, $user_id);

        if($request->is('account/*')) {
            return redirect()->back();
        } elseif($request->is('admin/*')) {
            return redirect('admin/manage-users/freelancer/bank/'.$user_id); 
        }

        return redirect('register/freelancer/bank/'.$user_id); 
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function bank(Request $request, $user_id = null)
    {
        $data = [];
        $model = null;
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }

        if($user_id) {
            Account::createAccount();
            $model = Account::where('user_id', $user_id)->first();
        }
        $data['model'] = $model;

        if($request->is('account/*')) {
            return view('accounts.accounts.general', $data);
        } elseif($request->is('admin/*')) {
            return view('admin.manage-users.users.general', $data);
        }

        return view('auth.register-freelancer.bank', $data); 
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function store_bank(Request $request, $user_id = null)
    {
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }

        $data = $request->all();

        if($request->submit == 'continue') {
            $rules = [];
        } else {
            $rules = [
                'mobile_network' => ['required', 'string'],
                'mobile_number' => ['required', 'string'],
                'mobile_account_name' => ['required', 'string'],
                // 'bank_name' => ['required', 'string'],
                // 'bank_account_name' => ['required', 'string'],
                // 'bank_account_number' => ['required', 'string'],
            ];
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $account_body = [
            'mobile_network' => isset($data['mobile_network'])? $data['mobile_network']: null,
            'mobile_number' => isset($data['mobile_number'])? $data['mobile_number']: null,
            'mobile_account_name' => isset($data['mobile_account_name'])? $data['mobile_account_name']: null,
            'bank_name' => isset($data['bank_name'])? $data['bank_name']: null,
            'bank_account_name' => isset($data['bank_account_name'])? $data['bank_account_name']: null,
            'bank_account_number' => isset($data['bank_account_number'])? $data['bank_account_number']: null,
        ];

        Account::where('user_id', $user_id)->update($account_body);

        $this->checkFreelancerStatus($request, $user_id);

        if($request->is('account/*')) {
            return redirect()->back();
        } elseif($request->is('admin/*')) {
            return redirect('admin/manage-users/freelancer/education/'.$user_id); 
        }

        if(Auth::user()->is_type_freelancer()) {
            return redirect('register/freelancer/education/'.$user_id); 
        }

        return redirect('register/freelancer/referees/'.$user_id); 
        
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function education(Request $request, $user_id = null)
    {
        $data = [];
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }

        Account::createAccount();
        $user = User::where('user_id', $user_id)->first();
        $account = Account::where('user_id', $user_id)->first();
        $educations_list = AccountEducation::where('account_id', $account->account_id)->get();

        $data['educations_list'] = $educations_list;
        $data['user'] = $user;
        $data['account'] = $account;

        if($request->is('account/*')) {
            return view('accounts.accounts.general', $data);
        } elseif($request->is('admin/*')) {
            return view('admin.manage-users.users.general', $data);
        }

        return view('auth.register-freelancer.education', $data); 
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function store_education(Request $request, $user_id = null)
    {
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }

        $data = $request->all();

        if($request->submit == 'continue') {
            $rules = [];
        } else {
            $rules = [
                'educations_list.*.institute_name' => ['required'],
                'educations_list.*.graduete_year' => ['required', 'numeric', 'digits:4'],
                'educations_list.*.type' => ['required'],
            ];
        }
        
        
        $messages = [
            'educations_list.*.institute_name.required' => 'Name of school or institute.',
            'educations_list.*.graduete_year.required' => 'Tell us when did you graduate.',
            'educations_list.*.graduete_year.numeric' => 'Year must be in number.',
            'educations_list.*.graduete_year.digits' => 'Year must be in 4 digits (eg. XXXX).',
            'educations_list.*.type.required' => 'Please select the education level.',
            'educations_list.*.document.required' => 'Please attach you certificate.',
            'educations_list.*.document.file' => 'Must be a file.',
            'educations_list.*.document.max' => 'Document must be less then 65000.',
            'educations_list.*.document.max' => 'Document must be jpg,jpeg,png or pdf.',
        ];

        if(is_array($request->educations_list)) {
            foreach ($request->educations_list as $key => $elem) {
                if( !(isset($elem['document_old']) && $elem['document_old']) ) {
                    $rules['educations_list.'.$key.'.document'] = ['required', 'file', 'max:65000', 'mimes:jpg,jpeg,png,pdf'];
                }
            }
        }

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(is_array($request->educations_list)) {
            foreach ($request->educations_list as $key => $elem) {
                $document = null;
                try {
                    $account_id = Account::where('user_id', $user_id)
                        ->pluck('account_id')
                        ->first();

                    $account_education = AccountEducation::where('account_id', $account_id)
                        ->where('type', $elem["type"])
                        ->first();

                    if(isset($elem['document'])){
                        $document = Helper::save_file($elem['document']);
                    } elseif(isset($elem['document_old'])) {
                        $document = $elem['document_old'];
                    }

                    $body = [
                        "institute_name" => $elem["institute_name"],
                        "graduete_year" => $elem["graduete_year"],
                        "type" => $elem["type"],
                    ];

                    if($account_education) {
                        $body['document'] = $document;
                        $account_education->update($body);
                    } else {
                        $body['account_id'] = $account_id;
                        $body['document'] = $document;
                        AccountEducation::create($body);
                    }
                } catch (\Exception $ex) {
                    return redirect()->back()->withErrors(['fail'=>$ex->getMessage()]);
                }
            }
        }

        $this->checkFreelancerStatus($request, $user_id);

        if($request->is('account/*')) {
            return redirect()->back();
        } elseif($request->is('admin/*')) {
            return redirect('admin/manage-users/freelancer/referees/'.$user_id); 
        }

        return redirect('register/freelancer/referees/'.$user_id); 
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function referees(Request $request, $user_id = null)
    {
        $data = [];
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }

        Account::createAccount();
        $user = User::where('user_id', $user_id)->first();
        $account = Account::where('user_id', $user_id)->first();
        $referees_list = AccountReferee::with(['location.location.location'])
            ->where('account_id', $account->account_id)
            ->get();

        $data['referees_list'] = $referees_list;
        $data['locations_list'] = Location::with(['location.location.location'])->get();
        $data['user'] = $user;
        $data['account'] = $account;

        if($request->is('account/*')) {
            return view('accounts.accounts.general', $data);
        } elseif($request->is('admin/*')) {
            return view('admin.manage-users.users.general', $data);
        }

        return view('auth.register-freelancer.referees', $data); 
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function store_referees(Request $request, $user_id = null)
    {
        // dd($request->all());
        $user_id = ($user_id)? $user_id: user('user_id');
        if(session('admin_active_user_id')) {
            $user_id = session('admin_active_user_id');
        }

        $data = $request->all();

        if($request->submit == 'continue') {
            $rules = [];
        } else {
            $rules = [
                'referees_list.*.first_name' => ['required'],
                // 'referees_list.*.second_name' => ['required'],
                'referees_list.*.last_name' => ['required'],
                'referees_list.*.phone' => ['required'],
                'referees_list.*.occupation' => ['required'],
                'referees_list.*.location_id' => ['required'],
            ];
        }
        
        
        $messages = [
            'referees_list.*.required' => 'Please fill is required.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) { 
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(is_array($request->referees_list)) {
            foreach ($request->referees_list as $key => $elem) {
                $document = null;
                try {
                    $account_id = Account::where('user_id', $user_id)
                        ->pluck('account_id')
                        ->first();

                    $account_referee = AccountReferee::where('account_id', $account_id)
                        ->where('phone', $elem["phone"])
                        ->first();

                    $body = [
                        "first_name" => $elem["first_name"],
                        "second_name" => $elem["second_name"],
                        "last_name" => $elem["last_name"],
                        "phone" => $elem["phone"],
                        "occupation" => $elem["occupation"],
                        "location_id" => $elem["location_id"],
                        "address" => $elem["address"],
                    ];

                    if($account_referee) {
                        $account_referee->update($body);
                    } else {
                        $body['account_id'] = $account_id;
                        AccountReferee::create($body);
                    }
                } catch (\Exception $ex) {
                    return redirect()->back()->withErrors(['fail'=>$ex->getMessage()]);
                }
            }
        }

        $user = User::where('user_id', $user_id)->first();

        $this->checkFreelancerStatus($request, $user_id);

        if($request->is('account/*')) {
            return redirect()->back();
        } elseif($request->is('admin/*')) {
            return redirect('admin/manage-users/freelancer/list'); 
        }

        return redirect('account'); 
    }

    private function checkFreelancerStatus(Request $request, $user_id = null)
    {
        // $user_id = ($user_id)? $user_id: user('user_id');
        // if(session('admin_active_user_id')) {
        //     $user_id = session('admin_active_user_id');
        // }

        // $verified = VerifyFreelancer::handler($request, $user_id);

        // if($verified) {
        //     session([
        //         'modal_title'=>'Thank you',
        //         'modal_content'=>'Thank you for complete your registration',
        //     ]);
        // }
    }
}
