<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    public const S_01 = 'summission_charge';
    public const S_02 = 'due_time';
    
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
    protected $table = 'settings';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
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
            $model->name = (string) Str::slug($model->name, '_');
        });
    }

    public static function setValue($key, $value) {
        $setting = Setting::where('name', $key)->first();

        if($setting) {
            $setting->update(['value'=>$value]);
        } else {
            Setting::create([
                'name' => $key,
                'value' => $value
            ]);
        }
    }

    public static function getValue($key) {
        return Setting::where('name', $key)->pluck('value')->first();
    }

    public static function setCommission(int $value) {
        self::setCommissionCharge($value);
    }

    public static function setCommissionCharge(int $value) {
        self::setValue(self::S_01, $value);
    }

    public static function getCommission() {
        return self::getCommissionCharge();
    }

    public static function getCommissionCharge() {
        $value = self::getValue(self::S_01);

        if(is_null($value)) {
            self::setValue(self::S_01, 20);
            $value = self::getValue(self::S_01);
        }

        return (int) $value;
    }

    public static function setDueTime(int $value) {
        self::setValue(self::S_02, $value);
    }

    public static function getDueTime() {
        $value = self::getValue(self::S_02);

        if(is_null($value)) {
            self::setValue(self::S_02, 7);
            $value = self::getValue(self::S_02);
        }

        return (int) $value;
    }
}

