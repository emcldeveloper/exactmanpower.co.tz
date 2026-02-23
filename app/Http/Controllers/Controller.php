<?php

namespace App\Http\Controllers;

use Helper;
use App\Models\User;
use App\Models\Account;
use App\Models\Merchant;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $api = false;

    public function __construct() {
        $request = request();

        if($request->is('api/*') || $request->is('mobile-api/*')) {
            $this->api = true;
        }

        $this->set_validation();
    }

    public function user($var = null){

        if(Auth::check()){
            $user = Auth::user();

            if(isset($user->$var)){
                return $user->$var;
            }

            return $user;
        }

        return null;
    }

    public function set_validation(){
        $vs = trans('validation');
        foreach($vs as $key => $value) {
            Helper::trans('validation.'.$key, $value);
        }
    }
}
