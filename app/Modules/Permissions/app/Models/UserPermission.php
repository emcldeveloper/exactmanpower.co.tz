<?php

namespace App\Modules\Permissions\app\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPermission extends Model
{
    // soft
    // use SoftDeletes;
    
    /**
     * The attribute associated with primary key in the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sys_user_permissions';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = [
    //     'deleted_at'
    // ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'sys_user_permission_id',
        'sys_role_id',
        'user_id',
        'sys_permission_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->sys_user_permission_id = (string) Str::uuid();
        });
    }
    
    /**
     * Retrieve related data from user_logs using undefined value.
     * @return array // array of user_logs
     */
    public function user()
	{
		return $this->belongsTo(RolePermission::class, 'user_id', 'user_id');
	}
    
    /**
     * Retrieve related data from user_logs using undefined value.
     * @return array // array of user_logs
     */
    public function role()
	{
		return $this->belongsTo(RolePermission::class, 'sys_role_id', 'sys_role_id');
	}
}

