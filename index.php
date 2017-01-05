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
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
        $reply_token = $event->getReplyToken();
        $text = $event->getText();
        if(stripos($text, "show user id") > -1){
            $bot->replyText($reply_token, $event->getUserId());
        } else {
            $bot->replyText($reply_token, $text);
        }
    }
}

echo "OK";  