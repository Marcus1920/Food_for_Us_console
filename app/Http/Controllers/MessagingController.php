<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Services\NotificationService;


class MessagingController extends Controller
{
    public function sendMessage()
    {
        $message = "New product posted";

        $newNotification = new NotificationService();

        $newNotification->sendToAll($message);

        return "ok";
//        $content = array(
//            "en" => 'New product posted'
//        );
//
//        $fields = array(
//            'app_id' => "65f845f6-abc5-4239-a94a-e66e50b49dd4",
//            'included_segments' => array('All'),
//            'data' => array("foo" => "bar"),
//            'contents' => $content
//        );
//
//        $fields = json_encode($fields);
//        print("\nJSON sent:\n");
//        print($fields);
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
//            'Authorization: Basic ZTRiZTIxMDUtOGJhYS00YzhiLTk5Y2UtOWIxMjA3MDY5N2Qy'));
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        curl_setopt($ch, CURLOPT_HEADER, FALSE);
//        curl_setopt($ch, CURLOPT_POST, TRUE);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//
//        $response = curl_exec($ch);
//        curl_close($ch);
//
//        return $response;
    }

}
