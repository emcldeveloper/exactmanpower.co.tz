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

class SendSMS
{
    private static $info_bip_base_url = "https://api.infobip.com/";
    private static $user_agent = "curl/7.35.0 (TiMETickets-SMS; Ubuntu 14.04.2 LTS;) Gecko/20100101 TTSMS/1";
    private static $headers = [
        'accept:application/json',
        'content-Type:application/json',
        'authorization: Basic VGltZVRaOlRpY2tldHMz',
        'accept-encoding:gzip'
    ];

    /**
     * @param $data array
     * @example $data = [
     *    "to"   => "255755001001",
     *    "text" => "message"
     * ];
     *
     * @return mixed
     */
    public static function send($phone = null, $message = null)
    {
        $data = [];
        $url = "sms/1/text/single";
        if(is_null($phone) || $phone == "" || is_null($message) || $message == ""){
            return false;
        }
        $data['from'] = config('app.sms_sender');
        $data['to'] = $phone; $data['text'] = $message;
        $postFields = json_encode($data);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$info_bip_base_url . $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, self::$headers);
        curl_setopt($ch, CURLOPT_user_agent, self::$user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

        //todo Check if response code is 200 or 300 then is successful otherwise return false
        $response = curl_exec($ch);
        Log::debug(json_encode($response));
        $http_response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($http_response_code == 200 || $http_response_code == 300)? $response : false;
    }
}