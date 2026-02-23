<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens, SoftDeletes;

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;
    public const STATUS_BANNED = 2;

    public const FREELANCER_STATUS_COMPLETE = 1;
    public const FREELANCER_STATUS_INCOMPLETE = 0;
    public const FREELANCER_STATUS_APPROVED = 2;
    public const FREELANCER_STATUS_REJECTED = 3;

    public const TYPE_FREELANCER = 0;
    public const TYPE_BUSINESS = 1;

    public const ROLE_ADMIN = 1;
    public const ROLE_MANAGER = 2;
    public const ROLE_FREELANCER = 10;
    public const ROLE_CUSTOMER = 20;

    public const STRONG_PASSWORD = "regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/";

    protected $primaryKey = 'id';

    protected $table = 'users';
    
    public $timestamps = false;

    protected $dates = [
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 
        'password',
        'first_name',
        'last_name',
        'username', 
        'profile_url', 
        'phone',
        'role',
        'token',
        'remember_token',
        'verification_code',
        'status',
        'freelancer_status',
        'freelancer_type',
        'created_at',
        'updated_at',
        'deleted_at',
        'email_verified_at',
        'phone_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = (string) Str::uuid();
        });
    }

    public static function scopeActive($query) {
        return $query->where('status', self::STATUS_ACTIVE);
    }
    
    public static function scopeInactive($query) {
        return $query->where('status', self::STATUS_INACTIVE);
    }
    
    public static function scopeBanned($query) {
        return $query->where('status', self::STATUS_BANNED);
    }
    
    public static function scopeComplete($query) {
        return $query->where('freelancer_status', self::FREELANCER_STATUS_COMPLETE);
    }
    
    public static function scopeIncomplete($query) {
        return $query->where(function($q){
            $q->whereNull('freelancer_status');
            $q->orWhere('freelancer_status', self::FREELANCER_STATUS_INCOMPLETE);
        });
    }

    public static function scopeApproved($query) {
        return $query->where('freelancer_status', self::FREELANCER_STATUS_APPROVED);
    }

    public static function scopeRejected($query) {
        return $query->where('freelancer_status', self::FREELANCER_STATUS_REJECTED);
    }

    public static function scopeAdmin($query) {
        return $query->where('role', self::ROLE_ADMIN);
    }

    public static function scopeManager($query) {
        return $query->where('role', self::ROLE_MANAGER);
    }

    public static function scopeSupport($query) {
        return $query->where('role', self::ROLE_MANAGER);
    }

    public static function scopeFreelancer($query) {
        return $query->where('role', self::ROLE_FREELANCER);
    }

    public static function scopeCustomer($query) {
        return $query->where('role', self::ROLE_CUSTOMER);
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_admin', 'is_support', 'is_manager',
        'is_active', 'is_inactive', 'is_banned', 'profile_image'
    ];

    private function _is_role($value) {
        $role = null;
        if( isset($this->attributes['role']) && !empty($this->attributes['role'])){
            $role = $this->attributes['role'];
        }

        if(is_array($value)) {
            return in_array($role, $value);
        } 

        return ($role == $value);
    }

    public function getIsAdminAttribute() {
        return $this->_is_role(self::ROLE_ADMIN);
    }

    public function getIsManagerAttribute() {
        return $this->getIsSupportAttribute();
    }

    public function getIsSupportAttribute() {
        return $this->_is_role([self::ROLE_MANAGER, self::ROLE_ADMIN]);
    }

    public function getIsFreelancerAttribute() {
        return $this->_is_role([self::ROLE_FREELANCER, self::ROLE_MANAGER, self::ROLE_ADMIN]);
    }

    public function getIsCustomerAttribute() {
        return $this->_is_role([self::ROLE_CUSTOMER, self::ROLE_FREELANCER, self::ROLE_MANAGER, self::ROLE_ADMIN]);
    }

    private function _is_status($status) {
        if( isset($this->attributes['status']) && !is_null($this->attributes['status']) && trim($this->attributes['status']) != "" ){
            return ($status == $this->attributes['status']);
        }

        return false;
    }

    public function getIsActiveAttribute() {
        return $this->_is_status(self::STATUS_ACTIVE);
    }

    public function getIsInactiveAttribute() {
        return $this->_is_status(self::STATUS_INACTIVE);
    }

    public function getIsBannedAttribute() {
        return $this->_is_status(self::STATUS_BANNED);
    }

    private function _is_freelancer_status($status) {
        if( isset($this->attributes['freelancer_status']) && !is_null($this->attributes['freelancer_status']) && trim($this->attributes['freelancer_status']) != "" ){
            return ($status == $this->attributes['freelancer_status']);
        }

        return false;
    }

    public function getIsCompleteAttribute() {
        return $this->_is_freelancer_status(self::FREELANCER_STATUS_COMPLETE);
    }

    public function getIsIncompleteAttribute() {
        return $this->_is_freelancer_status(self::FREELANCER_STATUS_INCOMPLETE);
    }

    public function getIsApprovedAttribute() {
        return $this->_is_freelancer_status(self::FREELANCER_STATUS_APPROVED);
    }

    public function getIsRejectedAttribute() {
        return $this->_is_freelancer_status(self::FREELANCER_STATUS_REJECTED);
    }

    private function _is_freelancer_type($status) {
        if( isset($this->attributes['freelancer_type']) && !is_null($this->attributes['freelancer_type']) && trim($this->attributes['freelancer_type']) != "" ){
            return ($status == $this->attributes['freelancer_type']);
        }

        return false;
    }

    public function getIsTypeFreelancerAttribute() {
        return $this->_is_freelancer_type(self::TYPE_FREELANCER);
    }

    public function getIsTypeBusinessAttribute() {
        return $this->_is_freelancer_type(self::TYPE_BUSINESS);
    }

    public function getIsPhoneVerifiedAttribute() {
        if( isset($this->attributes['phone_verified_at']) &&  $this->attributes['phone_verified_at'] && trim($this->attributes['phone_verified_at']) != "" ){
            return !is_null($this->attributes['phone_verified_at']);
        }

        return false;
    }

    public function getProfileImageAttribute()
    {
        $url = asset('img/avatar-placeholder.jpg');

        if( $this->attributes['profile_url'] || trim($this->attributes['profile_url']) != "" ){
            if(strpos('http', $this->attributes['profile_url']) === false){
                $url = asset('uploaded/'.$this->attributes['profile_url']);
            } else {
                $url = $this->attributes['profile_url'];
            }
        }

        return $url;
    }

    public function getBusinessNameAttribute() {
        
        if($this->account && $this->account->name) {
            return $this->account->name;
        } else if (isset($this->attributes['first_name']) && isset($this->attributes['last_name'])){
            return $this->attributes['first_name'].' '.$this->attributes['second_name'].' '.$this->attributes['last_name'];
        }

        return $this->phone_hint();
    }

    public function bills() {
        return $this->hasMany('App\Models\Invoice', 'user_id', 'user_id');
    }

    public function invoices() {

        return $this->hasManyThrough(
                'App\Models\Invoice',
                'App\Models\Order',
                'client_id', // Foreign key on orders table...
                'order_id', // Foreign key on invoices table...
                'user_id', // Local key on users table...
                'order_id' // Local key on orders table...
            );
    }


    public function user_permissions() {
        return $this->hasMany('App\Modules\Permissions\app\Models\UserGroup', 'user_id', 'user_id');
    }

    /**
     * Retrieve related data from service_type_elements using undefined value.
     * @return array // array of service_type_elements
     */
    public function permissions() {

        return $this->hasManyThrough(
                'App\Modules\Permissions\app\Models\GroupPermission', // table_3
                'App\Modules\Permissions\app\Models\UserGroup', // table_2
                'user_id', // Foreign key on table_2 table...
                'group_id', // Foreign key on table_3 table...
                'user_id', // Local key on table_1 table...
                'group_id' // Local key on table_2 table...
            );
    }

    /**
     * Retrieve related data from service_type_elements using undefined value.
     * @return array // array of service_type_elements
     */
    public function group()
	{
        return $this->hasOneThrough(
            'App\Modules\Permissions\app\Models\Group', // table_3
            'App\Modules\Permissions\app\Models\UserGroup', // table_2
            'user_id', // Foreign key on table_2 table...
            'group_id', // Foreign key on table_3 table...
            'user_id', // Local key on table_1 table...
            'group_id' // Local key on table_2 table...
        );
    }

    /**
     * Retrieve related data from service_type_elements using undefined value.
     * @return array // array of service_type_elements
     */
    public function services()
	{
		return $this->hasMany('App\Models\Service', 'user_id', 'service_author');
    }
    
    
    
    //  /**
    //  * Retrieve related data from service_type_elements using undefined value.
    //  * @return array // array of service_type_elements
    //  */
    // public function orders()
	// {
    //     $services_ids = $this->services()->pluck('service_id')->toArray();
    //     $orders = \App\Models\Orders::whereIn('service_id', $services_ids)->get();

    //     return $orders;
	// }

    

    public function get_profile()
    {
        $value = '<img src="'.$this->profile_image.'" class="rounded img-profile rounded-circle border border-dark w-100 h-100">';

        return $value;
    }

    public function get_profile_image()
    {
        return $this->profile_image;
    }

    public function get_profile_card($truncate = false)
    {
        $profile = $this->get_profile();
        $business_name = $this->getBusinessNameAttribute();
        $fullname = $this->getBusinessNameAttribute();
        $email = null;
        $truncate_class = null;

        if($this->attributes['email'] || trim($this->attributes['email']) != "" ){
            $email = $this->attributes['email'];
        }

        if($truncate) {
            $truncate_class = 'text-truncate col-12';
        }

        $value = <<<EOT
        <div class="media">
            <div class="media-image-sm align-self-center mr-2 w-100" style="max-width:30px;min-width:30px;max-height:30px;min-height:30px;">
                $profile
            </div>
            
            <div class="media-body text-left">
                <span class="d-inline-block $truncate_class p-0" style="max-width:150px;">$business_name</span>
                <div class="font-italic text-light small">$email</div>
            </div>
        </div>
EOT;

        return $value;
    }

    public function fullname() {
        
        if (isset($this->attributes['first_name']) && isset($this->attributes['last_name'])){
            return $this->attributes['first_name'].' '.$this->attributes['second_name'].' '.$this->attributes['last_name'];
        }

        return $this->phone_hint();
    }

    public function phone_hint(){
        return \App\Helpers\Helper::hide_some_digits($this->attributes['phone']);
    }

    
    public function get_status()
    {
        $value = '';
        $class = 'badge-success';
        $status = null;
        if(isset($this->attributes['status'])) {
            $status = $this->attributes['status'];
        }

        if($status == self::STATUS_ACTIVE) {
            $value = 'ACTIVE';
            $class = 'badge-success';
        } elseif($status == self::STATUS_INACTIVE) {
            $value = 'INACTIVE';
            $class = 'badge-secondary';
        } elseif($status == self::STATUS_BANNED) {
            $value = 'BANNED';
            $class = 'badge-danger';
        }

        return '<span class="badge badge-custom '.$class.'">'.$value.'</span>';
    }

    public function get_role()
    {
        $value = '';
        $status = null;
        $type = null;
        if(isset($this->attributes['role'])) {
            $status = $this->attributes['role'];
        }


        if($status == self::ROLE_ADMIN) {
            $value = 'ADMIN';
        } elseif($status == self::ROLE_MANAGER) {
            $value = 'MANAGER';
        } elseif($status == self::ROLE_FREELANCER && $this->getIsTypeBusinessAttribute()) {
            $value = 'BUSINESS';
        } elseif($status == self::ROLE_FREELANCER && $this->getIsTypeFreelancerAttribute()) {
            $value = 'FREELANCER';
        } elseif($status == self::ROLE_CUSTOMER) {
            $value = 'CUSTOMER';
        }

        return $value;
    }

    public function get_freelancer_type()
    {
        $value = '';
        $status = null;
        if(isset($this->attributes['freelancer_type'])) {
            $status = $this->attributes['freelancer_type'];
        }

        if($status == self::TYPE_FREELANCER){
            $value = 'Freelanser';
        } elseif($status == self::TYPE_BUSINESS){
            $value = 'Business';
        }


        return $value;
    }

    
}
