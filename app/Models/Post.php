<?php

namespace App\Models;

use DB;
use Share;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE = 1;

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
    protected $table = 'posts';
    
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
        'post_id',
        'post_title',
        'post_slug',
        'post_summary',
        'post_content',
        'btn_name',
        'post_featured_image',
        'post_featured_icon',
        'post_author',
        'custom_view_number',
        'post_date',
        'post_status',
        'post_modified',
        'post_type_id',
        'parent_post_id',
        'location_id',
        'event_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'post_team_position'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $appends = [
        'image_thumbnail', 'image', 'icon', 'has_image', 'is_active', 
    ];

    public static function boot()
    {
        parent::boot();
        PostType::checkDefault();
        // static::addGlobalScope('type', function (Builder $builder) {
        //     $builder->where('type', 'message');
        // });
        self::creating(function ($model) {
            $post_summary = ($model->post_content)? strip_tags($model->post_content): NULL;
            $post_summary = ($post_summary)? substr($post_summary, 0, 200): NULL;

            $model->post_id = (string) Str::uuid();
            $model->post_slug = self::slug($model->post_title);
            $model->post_summary = $post_summary;

            if(request('post_type_id') && is_null($model->post_type_id)) {
                $type_exists = PostType::where('post_type_id', request('post_type_id'))->exists();
                if($type_exists) {
                    $model->post_type_id = request('post_type_id');
                }
            }
        });

        self::updating(function ($model) {
            $post_summary = ($model->post_content)? strip_tags($model->post_content): NULL;
            $post_summary = ($post_summary)? substr($post_summary, 0, 200): NULL;

            $model->post_summary = $post_summary;
        });
    }
    
    public static function slug($title, $i = 0) 
    {
        $slug = Str::slug($title);
        if($i != 0) $slug .= "-".$i;

        $count = Post::where('post_slug', $slug)->count();
        if($count > 0) {
            $i = ($i <= $count)? ++$count: ++$i; 
            $slug = self::slug($title, $i);
        }

        return $slug;
    }

    public static function scopeActive($query) {
        return $query->where('post_status', self::STATUS_ACTIVE);
    }

    public static function scopeInactive($query) {
        return $query->where('post_status', self::STATUS_INACTIVE);
    }

    public static function scopeType($query, $type) {
        return $query->where('post_type_id', $type);
    }

    public static function scopePage($query){
        return self::scopeType($query, 'page');
    }

    public static function scopeBlog($query){
        return $query->whereIn('post_type_id', ['blog', 'newsroom', 'service']);
    }

    public static function scopeNewsroom($query){
        return self::scopeType($query, 'newsroom');
    }

    public static function scopeTestimony($query){
        return self::scopeType($query, 'testimony');
    }

    

    public static function scopeSlider($query){
        return self::scopeType($query, 'slider');
    }

    public static function scopeGeneral($query){
        return self::scopeType($query, 'general');
    }

    public static function scopeTeam($query){
        return self::scopeType($query, 'team');
    }

    public static function scopeService($query){
        return self::scopeType($query, 'service');
    }

    public static function scopeClient($query){
        return self::scopeType($query, 'client');
    }

    public static function scopePostType($query){
        return self::scopeType($query, 'post');
    }

    public static function scopeTag($query, $tags = []){
        if(!is_array($tags)) $tags = [$tags];

        $post_ids = PostTag::whereIn('tag_id', $tags)
            ->pluck('post_id')
            ->toArray();

        return $query->whereIn('post_id', $post_ids);
    }

    public static function scopeTagNot($query, $tags = []){
        if(!is_array($tags)) $tags = [$tags];

        $post_ids = PostTag::whereNotIn('tag_id', $tags)
            ->pluck('post_id')
            ->toArray();
            
        return $query->whereIn('post_id', $post_ids);
    }

    public function getIconAttribute() {
        $url = null;

        if(isset($this->attributes['post_featured_icon']) && !empty($this->attributes['post_featured_icon'])) {
            $file_name = $this->attributes['post_featured_icon'];

            $url = asset('uploaded/'.$file_name);
        }

        return $url; 
    }

    public function getImageAttribute($name = null) {
        $file_name = null;

        if(isset($this->attributes['post_featured_image']) && !empty($this->attributes['post_featured_image'])) {
            $file_name = $this->attributes['post_featured_image'];
        }

        if(
            isset($this->attributes['post_type_id']) &&
            (
                $this->attributes['post_type_id'] == 'magazine' ||
                $this->attributes['post_type_id'] == 'publication'
            )
        ) {
            $url = asset('img/document.png');
        } else {
            if($file_name) {
                $url = asset('uploaded/'.$file_name);
                if(!is_null($name)) {
                    $image = public_path('uploaded/'.$name.'-'.$file_name );
                    if(file_exists($image)) {
                        $url = asset('uploaded/'.$name.'-'.$file_name );
                    }
                }
            } else {
                $url = asset('img/placeholder.png');
            }
        }

        return $url; 
    }

    public function getImageThumbnailAttribute() {
        return  $this->getImageAttribute('thumbnail');
    }

    public function getIsActiveAttribute() {
        if( isset($this->attributes['post_status']) && !empty($this->attributes['post_status'])){
            return ($this->attributes['post_status'] == 1);
        }

        return false;
    }

    public function getHasImageAttribute() {
        if( isset($this->attributes['post_featured_image']) && !empty($this->attributes['post_featured_image'])){
            return (trim($this->attributes['post_featured_image']) !== '');
        }

        return false;
    }
    
    /**
     * Retrieve related data from users using undefined value.
     * @return Object // object of user
     */
    public function user()
	{
		return $this->belongsTo('App\Models\User', 'user_id', 'post_author');
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
     * Retrieve related data from posts using undefined value.
     * @return Object // object of post
     */
    public function post()
	{
		return $this->belongsTo('App\Models\Post', 'post_id', 'parent_post_id');
	}
    /**
     * Retrieve related data from locations using undefined value.
     * @return Object // object of location
     */
    public function location()
	{
		return $this->belongsTo('App\Models\Location', 'location_id', 'location_id');
    }
    
    /**
     * Retrieve related data from post_comments using undefined value.
     * @return array // array of post_comments
     */
    public function comments()
	{
		return $this->post_comments();
    }
    
    /**
     * Retrieve related data from post_comments using undefined value.
     * @return array // array of post_comments
     */
    public function post_comments()
	{
		return $this->hasMany('App\Models\PostComment', 'post_id', 'post_id');
	}

    public function post_view_analysis()
    {
        return $this->hasMany('App\Models\PostViewsAnalysis', 'post_id', 'post_id');
    }

    public function post_view_custom_positions()
    {
        return $this->hasMany('App\Models\PostViewCustomPosition', 'post_id', 'post_id');
    }

    /**
     * Retrieve related data from post_medias using undefined value.
     * @return array // array of post_medias
     */
    public function post_medias()
	{
		return $this->hasMany('App\Models\PostMedia', 'post_id', 'post_id');
	}
    /**
     * Retrieve related data from post_metas using undefined value.
     * @return array // array of post_metas
     */
    public function post_metas()
	{
		return $this->hasMany('App\Models\PostMeta', 'post_id', 'post_id');
	}
    /**
     * Retrieve related data from post_tags using undefined value.
     * @return array // array of post_tags
     */
    public function post_tags()
	{
		return $this->hasMany('App\Models\PostTag', 'post_id', 'post_id');
	}
    /**
     * Retrieve related data from posts using undefined value.
     * @return array // array of posts
     */
    public function posts()
	{
		return $this->hasMany('App\Models\Post', 'parent_post_id', 'post_id');
    }

    public function summary($length = 120) 
    {
        $summary = null;

        if(isset($this->attributes['post_content']) && $this->attributes['post_content'] && $this->attributes['post_content'] != '') {
            $summary = strip_tags($this->attributes['post_content']);
            $summary = substr($summary, 0, $length). '...';
        }

        return $summary;
    }

    public function get_featured_image() 
    {
        $url = asset('img/placeholder.png');

        if(isset($this->attributes['post_featured_image']) && $this->attributes['post_featured_image'] && $this->attributes['post_featured_image'] != '') {
            $url = asset('uploaded/'.$this->attributes['post_featured_image']);
        } else if(isset($this->attributes['post_id']) && $this->attributes['post_id'] && $this->attributes['post_id'] != '') {
            $file_name = DB::table('post_medias')
                ->where('post_id', $this->attributes['post_id'])
                ->pluck('name')
                ->first();

            if($file_name) {
                $url = asset('uploaded/'.$file_name);
            }
        }

        return $url;
    }
    
    public function share_message(){
        $post_title = null;
        if( isset($this->attributes['post_title']) ) {
            $post_title = $this->attributes['post_title'].", ". strip_tags($this->attributes['post_content']);
            if(request()->is('blog/*')) {
                $post_title = "Hi, Have a look at this Newsroom, I think you'll find it interesting. ".config('app.name')." - ".$post_title.". ";
            } else {
                $post_title = "Hi, Have a look at this News, I think you'll find it interesting. ".config('app.name')." - ".$post_title.". ";
            }
            
        }

        return $post_title;
    }

    public function share_link() {
        return url('blog/'.$this->attributes['post_slug']);
    }

    public function share_facebook()
    {
        return Share::load($this->share_link(), $this->share_message(), $this->get_featured_image())->facebook();
    }

    public function share_twitter()
    {
        return Share::load($this->share_link(), $this->share_message(), $this->get_featured_image())->twitter();
    }

    public function share_pinterest()
    {
        return Share::load($this->share_link(), $this->share_message(), $this->get_featured_image())->pinterest();
    }

    public function share_linkedin()
    {
        return Share::load($this->share_link(), $this->share_message(), $this->get_featured_image())->linkedin();
    }

    public function share_instagram()
    {
        return Share::load($this->share_link(), $this->share_message(), $this->get_featured_image())->instagram();
    }

    public function share_whatsapp() {
        $str = null;
        $query = null;
        $post_id = null;

        if(isset($this->attributes['post_author']) && $this->attributes['post_author'] && $this->attributes['post_author'] != '') {
            if( isset($this->attributes['id']) ){
                $post_id = $this->attributes['id'];
            }

            // $str .= "whatsapp://send?";
            $str .= "https://wa.me/?";

            $query .= "text=".urlencode($this->share_message());
            $query .= urlencode(url("post/".$post_id));
    
            return $str.$query;
        }

        return $str;
        
    }
}

