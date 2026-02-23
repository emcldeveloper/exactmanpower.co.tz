<?php

namespace App\Modules\Advert\Model;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class AdvertCategory extends Model
{
    protected $fillable = [
        'advert_category_id', 
        'name',
        'type', 
        'width', 
        'height',
        'descriptions',
        'price',
        'days',
        'status',
        'color',
        'background',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->advert_category_id = (string) Str::uuid();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adverts(){
        return $this->hasMany(Advert::class, 'advert_category_id', 'advert_category_id');
    }

    /**
     *
     */
    public function delete(){
        foreach($this->adverts as $advert){
            $advert->delete();
        }
    }
}
