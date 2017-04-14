<?php
define("LINE_MESSAGING_API_CHANNEL_SECRET", '6bc98df05d9d5dcab71a3552a395b420');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'yQRP6f8hTCddfvhemUfCGoiUtzg5c/hDzKhRXtwMKjGELpWz73zVfOAvvm31nsDEHJm3gDIT5M4nD5FyiAyaZ9QLP7xjfYRJVgfNP0rG+7ziKch4LfHWnoRdEFosESnLSQ3gb1xgHHknwILQL+l35gdB04t89/1O/w1cDnyilFU=');

require_once(__DIR__ . "/lib/vendor/autoload.php");

$bot = new \LINE\LINEBot(
    new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN),
    ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]
);

$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$body = file_get_contents("php://input");

$events = $bot->parseEventRequest($body, $signature);

foreach ($events as $event) {
    if ($event instanceof \LINE\LINEBot\Event\FollowEvent) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://61.63.6.146/cms/lineuser/" . $event->getUserId(),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: 111109d8-6f6d-d910-6b92-f4bd959201a6"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
    }
}

echo "OK";