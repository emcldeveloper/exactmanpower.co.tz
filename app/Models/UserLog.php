<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLog extends Model
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
    protected $table = 'user_logs';
    
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
        'user_log_id',
        'account_id',
        'user_id',
        'log_id',
        'datail',
        'timestamp',
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
            $model->user_log_id = (string) Str::uuid();
        });
    }
    
    /**
     * Retrieve related data from users using undefined value.
     * @return Object // object of user
     */
    public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
	}
    /**
     * Retrieve related data from logs using undefined value.
     * @return Object // object of log
     */
    public function log()
	{
		return $this->belongsTo('App\Models\Log', 'log_id', 'log_id');
	}
}

