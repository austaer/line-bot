<?php
require_once(__DIR__ . '/lib/src/LINEBot.php');

define("LINE_MESSAGING_API_CHANNEL_SECRET", '6bc98df05d9d5dcab71a3552a395b420');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'yQRP6f8hTCddfvhemUfCGoiUtzg5c/hDzKhRXtwMKjGELpWz73zVfOAvvm31nsDEHJm3gDIT5M4nD5FyiAyaZ9QLP7xjfYRJVgfNP0rG+7ziKch4LfHWnoRdEFosESnLSQ3gb1xgHHknwILQL+l35gdB04t89/1O/w1cDnyilFU=');

$channelSecret = LINE_MESSAGING_API_CHANNEL_SECRET;
$httpRequestBody = "";
$hash = hash_hmac('sha256', $httpRequestBody, $channelSecret, true);
$signature = base64_encode($hash);