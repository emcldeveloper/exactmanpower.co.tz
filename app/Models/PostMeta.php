<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostMeta extends Model
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
    protected $table = 'post_metas';
    
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
        'post_meta_id',
        'post_id',
        'meta_id',
        'value',
        'update_at',
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
            $model->post_meta_id = (string) Str::uuid();
        });
    }
    
    /**
     * Retrieve related data from posts using undefined value.
     * @return Object // object of post
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'post_id');
    }
    /**
     * Retrieve related data from metas using undefined value.
     * @return Object // object of meta
     */
    public function meta()
    {
        return $this->belongsTo('App\Models\Meta', 'meta_id', 'meta_id');
    }
}

