<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

// Replace the following
$token = '<insert token>';
$userId = -1;

$api = new \GusALN\TelegramBotApi\BotApi(
    $token,
    client: new \GusALN\TelegramBotApi\Client\GuzzleClient()
);

$message = $api->sendMessage(
    new \GusALN\TelegramBotApi\MethodRequests\SendMessageRequest(
        $userId,
        '<b>bold</b>, <strong>bold</strong>, <i>italic</i>, <em>italic</em>',
        parseMode: \GusALN\TelegramBotApi\Enums\ParseMode::HTML
    )
);
