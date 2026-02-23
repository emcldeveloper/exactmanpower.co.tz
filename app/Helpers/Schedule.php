<?php
/**
 * Created by VC.
 * User: Robert Konga
 * Date: 25/05/2019
 * Time: 04:09
 */

namespace App\Helpers;

use DB;
use Log;
use Carbon\Carbon;
use App\ScheduledNotification;
use App\Mail\Notification as MailNotification;
use App\Mail\Verification as MailVerification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\VerifiesEmails;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class Schedule
{
    const must_notifired = 'must_notifired';
    const credit_added = 'credit_added';
    const service_anquired_abused = 'service_anquired_abused';
    const service_approved = 'service_approved';
    const email_rejected = 'email_rejected';
    const draft_service_remainder = 'draft_service_remainder';
    const service_enquire = 'service_enquire';
    const other_notifired = 'other_notifired';
    const email_changed_confirm = 'email_changed_confirm';
    const email_verification_remainder = 'email_verification_remainder';
    const password_changed_confirm = 'password_changed_confirm';


    use VerifiesEmails;
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        
        if ($event->user instanceof MustVerifyEmail && !$event->user->hasVerifiedEmail()) {
            $message = new MailVerification($event->user);
                
            $data = [
                'receiver' => $event->user->email,
                'title' => $message->message->subject,
                'message' => $message->render(),
            ];

            self::email($data);
        }
    }

    public static function notifyAdmin($data = [], $type = null) 
    {
        $users = User::manager()->get();
        foreach($users as $row) {
            if($row->setting()) {
                $setting = $row->setting()->toArray();

                if($type == self::must_notifired || (isset($setting['is_'.$type.'_email']) && $setting['is_'.$type.'_email'])) {
                    if(!empty($row->email)) {
                        $data['receiver'] = $row->email;
                        self::email($data);
                    }
                }

                if($type == self::must_notifired || (isset($setting['is_'.$type.'_sms']) && $setting['is_'.$type.'_sms'])) {
                    $data['receiver'] = $row->phone;
                    self::sms($data);
                }

                $data['receiver'] = $row->user_id;
                self::local($data);
                self::push($data);
            }
        }
    }

    public static function notify($users = [], $data = [], $type = null) 
    {
        foreach($users as $row) {
            if($row->setting()) {
                $setting = $row->setting()->toArray();

                if($type == self::must_notifired || (isset($setting['is_'.$type.'_email']) && $setting['is_'.$type.'_email'])) {
                    if(!empty($row->email)) {
                        $data['receiver'] = $row->email;
                        self::email($data);
                    }
                }

                if($type == self::must_notifired || (isset($setting['is_'.$type.'_sms']) && $setting['is_'.$type.'_sms'])) {
                    $data['receiver'] = $row->phone;
                    self::sms($data);
                }

                $data['receiver'] = $row->user_id;
                self::local($data);
                self::push($data);
            }
        }
    }

    public static function sms($data = [])
    {
        self::schedule($data, ScheduledNotification::TYPE_SMS);
    }

    public static function email($data = [])
    {
        self::schedule($data, ScheduledNotification::TYPE_EMAIL);
    }

    public static function local($data = [])
    {
        self::schedule($data, ScheduledNotification::TYPE_LOCAL);
    }

    public static function push($data = [])
    {
        self::schedule($data, ScheduledNotification::TYPE_PUSH);
    }

    private static function schedule($data, $type = ScheduledNotification::TYPE_EMAIL)
    {
        $timestamp = date('Y-m-d H:i:s', time());

        $body = [
            'sender' => isset($data['sender']) ? $data['sender']: null,
            'receiver' => isset($data['receiver']) ? $data['receiver']: null,
            'title' => isset($data['title']) ? $data['title']: null,
            'message' => isset($data['message'])? $data['message']: '',
            'link' => isset($data['link'])? $data['link']: null,
            'data' => json_encode($data),
            'scheduled_time' => isset($data['scheduled_time'])? $data['scheduled_time']: $timestamp,
            'type' => isset($data['type'])? $data['type']: $type,
            'responce_text' => null,
            'responce_error' => null,
            'responce_id' => null,
            'status' => isset($data['status'])? $data['status']: ScheduledNotification::STATUS_SCHEDULED,
            'sent_time' => null,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ];

        ScheduledNotification::create($body);
    }
}