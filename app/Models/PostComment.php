<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PostComment extends Model
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
    protected $table = 'post_comments';
    
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
        'post_comment_id',
        'post_id',
        'comment_author',
        'comment_date',
        'comment_content',
        'comment_type',
        'parent_post_comment_id',
        'created_at',
        'updated_at',
        'user_id',
        'post_type_id'
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
            $model->post_comment_id = (string) Str::uuid();
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
     * Retrieve related data from post_comments using undefined value.
     * @return Object // object of post_comment
     */
    public function post_comment()
	{
		return $this->belongsTo('App\Models\PostComment', 'post_comment_id', 'parent_post_comment_id');
	}

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'user_id');
    }
    /**
     * Retrieve related data from post_comments using undefined value.
     * @return array // array of post_comments
     */
    public function post_comments()
	{
		return $this->hasMany('App\Models\PostComment', 'parent_post_comment_id', 'post_comment_id');
	}
}

