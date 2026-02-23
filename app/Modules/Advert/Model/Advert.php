<?php
namespace App\Modules\Advert\Model;

use App\Models\Category;

use File;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Modules\Advert\Model\AdvertCategory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advert extends Model
{
    public const STATUS_DRAFT = 0;
    public const STATUS_PENDING = 1;
    public const STATUS_REJECTED = 2;
    public const STATUS_APPROVED = 3;

    // soft
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'viewed_at',
        'deleted_at'
    ];
    
    protected $fillable = [
        'alt',
        'advert_id',
        'advert_unique',
        'user_id',
        'url',
        'image_url',
        'image_path',
        'views',
        'clicks',
        'active',
        'status',
        'expired_date',
        'category_id',
        'advert_category_id',
        'deleted_at'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->advert_id = (string) Str::uuid();
            $model->advert_unique = self::set_unique($model, false);
        });

        self::updating(function ($model) {
            // dd($model);
            if(!$model->advert_unique) {
                $model->advert_unique = self::set_unique($model, false);
            }
        });
    }

    public static function set_unique($model, $reset = true) 
    {
        $value = null;
        if($model->category_id && !$model->advert_unique) {
            $pri = Category::where('category_id', $model->category_id)
                ->pluck('category_unique')
                ->first();

            if(!$pri) {
                Category::updateUnique($model->category_id);

                $pri = Category::where('category_id', $model->category_id)
                    ->pluck('category_unique')
                    ->first();
            }

            $value = $pri.'-'.self::uniqid();
            if($reset) {
                Advert::where('advert_id', $model->advert_id)->update([
                    'advert_unique' => $value
                ]);

                return;
            }
        }

        return $value;
    }

    public static function uniqid() 
    {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $uniqid = substr(str_shuffle($permitted_chars), 0, 6);

        $count = Advert::where('advert_unique', $uniqid)->count();
        if($count > 0) {
            $uniqid = self::uniqid();
        }

        return $uniqid;
    }

    /**
     * @param array $data
     * @param UploadedFile $image
     * @return Advert
     * @throws \Exception
     */
    public static function make(array $data, UploadedFile $image = null){
        if(!$image){
            throw new \Exception('UploadedFile required');
        }

        $validator = Validator::make(
            $data,
            [
                'url' => 'required',
                'active' => 'boolean',
                'account_id' => 'required|exists:accounts,account_id',
                'advert_category_id' => 'required|exists:advert_categories,advert_category_id'
            ]
        );

        if ($validator->fails())
        {
            throw new \Exception($validator->messages()->first());
        }

        $advert = Advert::create($data);
        $advert->saveImage($image);

        return $advert;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query){
        return $query->where('active', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function advert_category(){
        return $this->belongsTo(AdvertCategory::class, 'advert_category_id', 'advert_category_id');
    }

    /**
     * @return bool
     */
    public function activate(){
        return $this->update(['active' => true]);
    }

    /**
     * @return bool
     */
    public function deactivate(){
        return $this->update(['active' => false]);
    }

    /**
     * @return bool
     */
    public function approve(){
        return $this->update(['status'=>self::STATUS_APPROVED]);
    }

    /**
     * @return bool
     */
    public function reject(){
        return $this->update(['status'=>self::STATUS_REJECTED]);
    }

    /**
     * @return bool
     */
    public function plusViews(){
        return $this->update(['views' => $this->views+1]);
    }

    /**
     * @return bool
     */
    public function plusClicks(){
        return $this->update(['clicks' => $this->clicks+1]);
    }

    /**
     * @return bool
     */
    public function resetViews(){
        return $this->update(['views' => 0]);
    }

    /**
     * @return bool
     */
    public function resetClicks(){
        return $this->update(['clicks' => 0]);
    }

    /**
     * @return bool
     */
    public function updateLastViewed(){
        $this->viewed_at = Carbon::now();
        return $this->save();
    }

    /**
     * @param string $extension
     * @return string
     */
    public static function generateImageName($extension = 'png'){
        return Carbon::now()->timestamp.'_'.str_random(8).'.'.$extension;
    }


    /**
     * @param UploadedFile $file
     */
    public function saveImage(UploadedFile $file){
        $this->deleteImage();
        $image = Image::make($file);
        $image_name = Advert::generateImageName();
        $advert_category = $this->advert_category;
        $width = $advert_category->width?$advert_category->width:null;
        $height = $advert_category->height?$advert_category->height:null;
        if($advert_category->width === null || $advert_category->height === null){
            $image->resize($advert_category->width, $advert_category->height, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->resize($advert_category->width, $advert_category->height);
        }

        File::put(base_path(config('laravel-advert.upload_path').'/'.$image_name), $image->stream()->__toString());

        $this->update([
            'image_url' => $image_name,
            'image_path' => $image_name
        ]);
    }

    /**
     * @throws \Exception
     */
    public function delete(){
        $this->deleteImage();
        parent::delete();
    }

    /**
     *
     */
    private function deleteImage(){
        $file_path = base_path(config('laravel-advert.upload_path').'/'.$this->image_path);

        if(file_exists($file_path) && $this->image_path !== null){
            // $storage->delete($this->image_path);
            unlink($file_path);
        }
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getURL(){
        return url('a/'.$this->id);
    }


    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getImageUrl(){

        return url(config('laravel-advert.upload_path').'/'.$this->image_path);
    }

    public function getStatus()
    {
        $value = '';
        $status = null;
        if(isset($this->attributes['status'])) {
            $status = $this->attributes['status'];
        }

        if($status == self::STATUS_DRAFT) {
            $value = 'DRAFT';
        } elseif($status == self::STATUS_PENDING) {
            $value = 'PENDING';
        } elseif($status == self::STATUS_REJECTED) {
            $value = 'REJECTED';
        } elseif($status == self::STATUS_APPROVED) {
            $value = 'APPROVED';
        }

        return $value;
    }
}
