<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostType extends Model
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
    protected $table = 'post_types';
    
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
        'post_type_id',
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public static $default_types = [
        'page', 'post', 'testimony', 'slider',  
        'team', 'service', 'client', 'general'
    ];

    public static function boot()
    {
        parent::boot();
        PostType::checkDefault();
        self::creating(function ($model) {
            $model->post_type_id = (string) self::slug($model->name);
        });
    }

    public static function slug($title, $i = 0) 
    {
        $slug = Str::slug($title);
        if($i != 0) $slug .= "-".$i;

        $count = PostType::where('post_type_id', $slug)->count();
        if($count > 0) {
            $i = ($i <= $count)? ++$count: ++$i; 
            $slug = self::slug($title, $i);
        }

        return $slug;
    }

    public static function scopeCheckDefault($query) {
        $exists = PostType::whereIn('post_type_id', self::$default_types)->count();

        if($exists != count(self::$default_types)) {
            foreach(self::$default_types as $id) {
                $test = PostType::where('post_type_id', $id)->exists();
                if(!$test) {
                    PostType::create([
                        'post_type_id' => $id,
                        'name' => Str::title($id),
                    ]);
                }
            }
        }
        return $query;
    }

    public static function scopeType($query, $type) {
        return $query->where('post_type_id', $type);
    }
    
    /**
     * Retrieve related data from metas using undefined value.
     * @return array // array of metas
     */
    public function metas()
	{
		return $this->hasMany('App\Models\Meta', 'post_type_id', 'post_type_id');
	}
    /**
     * Retrieve related data from posts using undefined value.
     * @return array // array of posts
     */
    public function posts()
	{
		return $this->hasMany('App\Models\Post', 'post_type_id', 'post_type_id');
	}
}

