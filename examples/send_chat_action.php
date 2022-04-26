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

$api->sendChatAction(
    new \GusALN\TelegramBotApi\MethodRequests\SendChatActionRequest(
        $userId,
        \GusALN\TelegramBotApi\Enums\ChatAction::TYPING
    )
);
