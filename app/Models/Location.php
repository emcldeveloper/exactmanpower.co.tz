<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
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
    protected $table = 'locations';
    
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
        'location_id',
        'name',
        'parent_location_id',
        'type',
        'latitude',
        'longitude',
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
            $model->location_id = (string) Str::uuid();
        });
    }
    
    /**
     * Retrieve related data from locations using undefined value.
     * @return Object // object of location
     */
    public function location()
	{
		return $this->belongsTo('App\Models\Location', 'location_id', 'parent_location_id');
	}
    /**
     * Retrieve related data from locations using undefined value.
     * @return array // array of locations
     */
    public function locations()
	{
		return $this->hasMany('App\Models\Location', 'parent_location_id', 'location_id');
	}
    /**
     * Retrieve related data from posts using undefined value.
     * @return array // array of posts
     */
    public function posts()
	{
		return $this->hasMany('App\Models\Post', 'location_id', 'location_id');
	}
}

