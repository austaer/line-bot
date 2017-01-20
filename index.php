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


$file = fopen("tempfile.txt" , 'a');
fwrite($file, implode("\t" , $body ). "\n");
fclose($file);

$events = $bot->parseEventRequest($body, $signature);

$file = fopen("tempfile.txt" , 'a');
fwrite($file, implode("\t" , $events ). "\n");
fclose($file);


foreach ($events as $event) {
    if ($event instanceof \LINE\LINEBot\Event\FollowEvent) {
        $file = fopen("tempfile.txt" , 'a');
        fwrite($file, $event->getUserId() . "\n");
        fclose($file);
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder("安安");
        $response = $bot->pushMessage($event->getUserId(), $textMessageBuilder);
    }
}



echo $response->getHTTPStatus() . ' ' . $response->getRawBody();

echo "OK";