<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduledNotification extends Model
{
    // use SoftDeletes;

    const NOTIFICATION_SCHEDULED = 'SCHEDULED';
    const NOTIFICATION_PENDING = 'PENDING';
    const NOTIFICATION_SENT = 'SENT';
    const NOTIFICATION_DELIVERED = 'DELIVERED';
    const NOTIFICATION_UNDELIVERED = 'UNDELIVERED';
    const NOTIFICATION_REJECTED = 'REJECTED';
    const NOTIFICATION_EXPIRED = 'EXPIRED';
    const NOTIFICATION_CANCEL = 'CANCEL';

    protected $perPage = 30;
    
    protected $primaryKey = 'scheduled_notification_id';

    protected $table = 'scheduled_notifications';
    
    public $timestamps = false;

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
        'sender_title',
        'message',
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

}
