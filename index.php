<?php
define("LINE_MESSAGING_API_CHANNEL_SECRET", '6bc98df05d9d5dcab71a3552a395b420');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'yQRP6f8hTCddfvhemUfCGoiUtzg5c/hDzKhRXtwMKjGELpWz73zVfOAvvm31nsDEHJm3gDIT5M4nD5FyiAyaZ9QLP7xjfYRJVgfNP0rG+7ziKch4LfHWnoRdEFosESnLSQ3gb1xgHHknwILQL+l35gdB04t89/1O/w1cDnyilFU=');

require_once(__DIR__ . "/lib/vendor/autoload.php");

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($_GET['msg']);
$response = $bot->pushMessage('Ueeeaeaa9ab46d711b69d251f57561622', $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
echo "OK";  