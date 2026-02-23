<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagType extends Model
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
    protected $table = 'tag_types';
    
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
        'tag_type_id',
        'name',
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
            // $model->tag_type_id = (string) Str::uuid();
            $model->tag_type_id = (string) self::slug($model->name);
        });
    }

    public static function slug($title, $i = 0) 
    {
        $slug = Str::slug($title);
        if($i != 0) $slug .= "-".$i;

        $count = TagType::where('tag_type_id', $slug)->count();
        if($count > 0) {
            $i = ($i <= $count)? ++$count: ++$i; 
            $slug = self::slug($title, $i);
        }

        return $slug;
    }
    
    /**
     * Retrieve related data from post_tags using undefined value.
     * @return array // array of post_tags
     */
    public function post_tags()
	{
		return $this->hasMany('App\Models\PostTag', 'tag_type_id', 'tag_type_id');
	}
    /**
     * Retrieve related data from tags using undefined value.
     * @return array // array of tags
     */
    public function tags()
	{
		return $this->hasMany('App\Models\Tag', 'tag_type_id', 'tag_type_id');
	}
}

