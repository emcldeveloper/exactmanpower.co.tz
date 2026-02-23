<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
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
    protected $table = 'tags';
    
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
        'tag_id',
        'name',
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
            // $model->tag_id = (string) Str::uuid();
            $model->tag_id = (string) self::slug($model->name);
        });
    }

    public static function slug($title, $i = 0) 
    {
        $slug = Str::slug($title);
        if($i != 0) $slug .= "-".$i;

        $count = Tag::where('tag_id', $slug)->count();
        if($count > 0) {
            $i = ($i <= $count)? ++$count: ++$i; 
            $slug = self::slug($title, $i);
        }

        return $slug;
    }

    public static function scopeBlog($query) {
        return $query->where('tag_type_id', 'blog');
    }

    public static function scopeCategory($query) {
        return $query->where('tag_type_id', 'categories');
    }
    
    /**
     * Retrieve related data from tag_types using undefined value.
     * @return Object // object of tag_type
     */
    public function tag_type()
	{
		return $this->belongsTo('App\Models\TagType', 'tag_type_id', 'tag_type_id');
	}
    /**
     * Retrieve related data from post_tags using undefined value.
     * @return array // array of post_tags
     */
    public function post_tags()
	{
		return $this->hasMany('App\Models\PostTag', 'tag_id', 'tag_id');
	}
}

