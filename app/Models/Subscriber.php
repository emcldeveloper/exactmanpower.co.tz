<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
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
    protected $table = 'subscribers';
    
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
        'subscriber_id',
        'email',
        'query',
        'subscription_type_id',
        'is_valid',
        'status',
        'notes',
        'timestamp',
        'deactivated_at',
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
            $model->subscriber_id = (string) Str::uuid();
        });
    }
    
    /**
     * Retrieve related data from subscription_types using undefined value.
     * @return Object // object of subscription_type
     */
    public function subscription_type()
	{
		return $this->belongsTo('App\Models\SubscriptionType', 'subscription_type_id', 'subscription_type_id');
	}
            
    public function getIsValidAttribute()
    {
        if( isset($this->attributes['is_valid']) && !empty($this->attributes['is_valid']) ){
            return ($this->attributes['is_valid'] == 1);
        }

        return false;
    }
}

