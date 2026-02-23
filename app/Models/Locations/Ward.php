<?php

namespace App\Models\Locations;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ward extends Model
{
    private const TYPE = 3;
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

        static::addGlobalScope('location_type', function (Builder $builder) {
            $builder->where('type', self::TYPE);
        });

        self::creating(function ($model) {
            $model->location_id = (string) Str::uuid();
            $model->type = self::TYPE;
            // $model->parent_location_id = null;
        });
    }
    
    /**
     * Retrieve related data from locations using undefined value.
     * @return Object // object of location
     */
    public function district()
	{
		return $this->belongsTo('App\Models\Locations\District', 'location_id', 'parent_location_id');
	}
}

