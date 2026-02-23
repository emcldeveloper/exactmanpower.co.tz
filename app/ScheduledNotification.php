<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduledNotification extends Model
{
    // soft
    // use SoftDeletes;

    const STATUS_NONE = 0;
    const STATUS_SCHEDULED = 1;
    const STATUS_PENDING = 2;
    const STATUS_SENT = 3;
    const STATUS_DELIVERED = 4;
    const STATUS_UNDELIVERED = 5;
    const STATUS_REJECTED = 6;
    const STATUS_EXPIRED = 7;
    const STATUS_CANCEL = 8;

    const TYPE_EMAIL = 0;
    const TYPE_SMS = 1;
    const TYPE_LOCAL = 2;
    const TYPE_PUSH = 3;
    
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
    protected $table = 'scheduled_notifications';
    
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
        'scheduled_notification_id',
        'sender',
        'receiver',
        'title',
        'message',
        'link',
        'data',
        'scheduled_time',
        'type',
        'responce_text',
        'responce_error',
        'responce_id',
        'status',
        'sent_time',
        'created_at',
        'updated_at',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    private static $columns = [
        'scheduled_notification_id',
        'sender',
        'receiver',
        'title',
        'message',
        'link',
        'data',
        'scheduled_time',
        'type',
        'responce_text',
        'responce_error',
        'responce_id',
        'status',
        'sent_time',
        'created_at',
        'updated_at',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->scheduled_notification_id = (string) Str::uuid();
        });
    }

    public static function scopeExclude($query,$value = array()) 
    {
        return $query->select( array_diff( self::$columns,(array) $value) );
    }

    public static function scopeOnTime($query) {
        $timestamp = date('Y-m-d H:i:s', time());
        return $query->where('scheduled_time', '<', $timestamp);
        // return $query;
    }

    public static function scopeEmail($query) {
        return $query->where('type', self::TYPE_EMAIL);
    }

    public static function scopeSms($query) {
        return $query->where('type', self::TYPE_SMS);
    }

    public static function scopeLocal($query) {
        return $query->where('type', self::TYPE_LOCAL);
    }

    public static function scopePush($query) {
        return $query->where('type', self::TYPE_PUSH);
    }
    
    public static function scopeQueued($query) {
        return $query->where('status', self::STATUS_PENDING);
    }
    
    public static function scopeScheduled($query) {
        return $query->where('status', self::STATUS_SCHEDULED);
    }
    
    public static function scopeSent($query) {
        return $query->where('status', self::STATUS_SENT);
    }

    public function scopeSetScheduled($query) {
        $timestamp = date('Y-m-d H:i:s', time());
        
        return $query->update([
            'sent_time'=>null,
            'status' => self::STATUS_SCHEDULED
        ]);
    }

    public function scopeSetQueue($query) {
        $timestamp = date('Y-m-d H:i:s', time());
        
        return $query->update([
            'sent_time'=>$timestamp,
            'status' => self::STATUS_PENDING
        ]);
    }

    public function scopeSetSent($query) {
        $timestamp = date('Y-m-d H:i:s', time());

        return $query->update([
            'sent_time'=>$timestamp,
            'status' => self::STATUS_SENT
        ]);
    }

    public function scopeSetDelivered($query) {
        return $query->update(['status' => self::STATUS_DELIVERED]);
    }

    public function is_sent() {
        if( isset($this->attributes['status']) && !is_null($this->attributes['status']) && trim($this->attributes['status']) != "" ){
            return (self::STATUS_SENT == $this->attributes['status']);
        }

        return false;
    }
}

