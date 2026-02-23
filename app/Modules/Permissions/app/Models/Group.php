<?php

namespace App\Modules\Permissions\app\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
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
    protected $table = 'groups';
    
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
        'group_id',
        'name',
        'description',
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
            $model->group_id = (string) Str::uuid();
        });
    }
    
    /**
     * Retrieve related data from user_logs using undefined value.
     * @return array // array of user_logs
     */
    public function permissions()
	{
		return $this->hasMany(GroupPermission::class, 'group_id', 'group_id');
    }
    
    /**
     * Retrieve related data from user_logs using undefined value.
     * @return array // array of user_logs
     */
    public function users()
	{
		return $this->hasMany(UserGroup::class, 'group_id', 'group_id');
	}
}

