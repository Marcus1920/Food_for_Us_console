<?php

namespace App\Services;

use Illuminate\Foundation\Http\Requests;

class NotificationService
{
    public function sendToAll($message)
    {
        $content = array(
            "en" => $message
        );

        $fields = array(
            'app_id' => "dbc457c7-6174-4962-bc4c-3c1f7ccb3241",
            'included_segments' => array('All'),
            'data' => array("foo" => "bar"),
            'contents' => $content
        );

        $fields = json_encode($fields);
//        print("\nJSON sent:\n");
//        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic OGZlYTlhMjEtODI0ZS00NWJhLThhM2YtM2JlNDZmYmI0Zjk5'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
    public function sendToOne($message,$PlayerID)
    {
        $content = array(
            "en" => $message
        );

        $fields = array(
            'app_id' => "dbc457c7-6174-4962-bc4c-3c1f7ccb3241",
            'include_player_ids' => array($PlayerID),
            'data' => array("foo" => "bar"),
            'contents' => $content
        );

        $fields = json_encode($fields);
//        print("\nJSON sent:\n");
//        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic OGZlYTlhMjEtODI0ZS00NWJhLThhM2YtM2JlNDZmYmI0Zjk5'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}