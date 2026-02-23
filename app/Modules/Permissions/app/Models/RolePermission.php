<?php

namespace App\Modules\Permissions\app\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
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
    protected $table = 'sys_role_permissions';
    
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
        'sys_role_permission_id',
        'sys_role_id',
        'sys_permission_id',
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
            $model->sys_role_permission_id = (string) Str::uuid();
        });
    }
    
    /**
     * Retrieve related data from user_logs using undefined value.
     * @return array // array of user_logs
     */
    public function role()
	{
		return $this->belongsTo(Role::class, 'sys_role_id', 'sys_role_id');
	}
    
    /**
     * Retrieve related data from user_logs using undefined value.
     * @return array // array of user_logs
     */
    public function permission()
	{
		return $this->belongsTo(Permission::class, 'sys_permission_id', 'sys_permission_id');
	}
}

