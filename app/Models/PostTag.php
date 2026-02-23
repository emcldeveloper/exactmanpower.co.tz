<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostTag extends Model
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
    protected $table = 'post_tags';
    
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
        'post_tag_id',
        'post_id',
        'tag_id',
        'tag_type_id',
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
            $model->post_tag_id = (string) Str::uuid();
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
     * Retrieve related data from tags using undefined value.
     * @return Object // object of tag
     */
    public function tag()
	{
		return $this->belongsTo('App\Models\Tag', 'tag_id', 'tag_id');
	}
    /**
     * Retrieve related data from tag_types using undefined value.
     * @return Object // object of tag_type
     */
    public function tag_type()
	{
		return $this->belongsTo('App\Models\TagType', 'tag_type_id', 'tag_type_id');
	}
}

