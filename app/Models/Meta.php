<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
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
    protected $table = 'metas';
    
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
        'meta_id',
        'name',
        'input_type',
        'multiple',
        'options',
        'post_type_id',
        'linked_type_id',
        'linked_tag_id',
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
            $model->meta_id = (string) Str::uuid();
        });
    }
    
    /**
     * Retrieve related data from post_types using undefined value.
     * @return Object // object of post_type
     */
    public function post_type()
	{
		return $this->belongsTo('App\Models\PostType', 'post_type_id', 'post_type_id');
	}
    /**
     * Retrieve related data from post_metas using undefined value.
     * @return array // array of post_metas
     */
    public function post_metas()
	{
		return $this->hasMany('App\Models\PostMeta', 'meta_id', 'meta_id');
	}
}

