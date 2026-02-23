<?php

namespace App\Tasks;

use DB;
use App\Helpers\SendSMS;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;

class Notification
{
    public static function process(){
        $is_previous_job_done = true;
        $timestamp = date('Y-m-d H:i:s');

        $job_log = DB::table('cron_job_logs')->whereNull('end_time')->first();
        if(!is_null($job_log)){
            if(strtotime($job_log->start_time) < (strtotime($timestamp) - 60*60*1)){
                DB::table('cron_job_logs')->whereNull('end_time')->update([
                    "notes"=>"Force terminated",
                    "end_time"=>$timestamp
                ]);

                $is_previous_job_done = true;
            } else {
                $is_previous_job_done = false;
            }
        }

        $total_entries = 0;
        $start_timestamp = date('Y-m-d H:i:s');
        DB::table('cron_job_logs')->insert([
            "start_time"=>$start_timestamp,
            "end_time"=>null,
        ]);

        if($is_previous_job_done) {
            $messages_list = ScheduledNotification::where('type', 'SMS')
                ->where('status', 0)
                ->get();

            foreach ($messages_list as $message) {
                $total_entries++;
                $thread_task = new ThreadTask($message, function($msg) {
                    if($msg->phone && $msg->text) {

                        $_start_sending_time = date('Y-m-d H:i:s', time());
                        $sendResult = SendSMS::send($msg->phone, $msg->text);
                        $_end_sending_time = date('Y-m-d H:i:s', time());
    
                        if($sendResult) {
                            $infobipResponse = json_decode($sendResult);
                            $_message = (array) $infobipResponse->messages;
                            $_message = (object) array_shift($_message);

                            $msgUpdates = [
                                'status' => ScheduledNotification::NOTIFICATION_SENT,
                                'date_sent' => Carbon::now(),
                                'sender_sms_id' => isset($_message->messageId)? $_message->messageId: null,
                                'sender_sms_response' => $sendResult,
                                'sms_sender_name' => 'INFOBIP',
                                'price_per_message' => "13.55",
                                'currency' => 'TZS',
                                'sender_sent_at' => $_start_sending_time,
                                'sender_done_at' => $_end_sending_time,
                            ];

                            if(isset($_message->status) && $_message->status && isset($_message->status->description)) {
                                $msgUpdates['status_description'] = $_message->status->description;
                            }
    
                            ScheduledNotification::where('id', $msg->id)->update($msgUpdates);
                        }
                    } else {
                        ScheduledNotification::where('id', $msg->id)->update($msg->id, [
                            'status' => ScheduledNotification::NOTIFICATION_CANCEL,
                            'date_sent' => Carbon::now(),
                            'sender_sms_id' => null,
                            'sender_sms_response' => null,
                            'sms_sender_name' => null,
                            'error' => "Invalid number or empty message",
                        ]);
                    }
                });

                $thread_task->start();
            }
        }

        $end_timestamp = date('Y-m-d H:i:s');
        DB::table('cron_job_logs')->whereNull('end_time')->update([
            "notes"=>"Completed (total entries: ".$total_entries.")",
            "end_time"=>$end_timestamp
        ]);
    }
}
