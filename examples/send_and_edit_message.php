<?php

declare(strict_types=1);

use GusALN\TelegramBotApi\Enums\ChatAction;

require __DIR__.'/../vendor/autoload.php';

// Replace the following
$token = '<insert token>';
$userId = -1;

$api = new \GusALN\TelegramBotApi\BotApi(
    $token,
    client: new \GusALN\TelegramBotApi\Client\GuzzleClient()
);

$message = $api->sendMessage(
    new \GusALN\TelegramBotApi\MethodRequests\SendMessageRequest($userId, 'Anakin Skywalker')
);

$api->sendChatAction(
    new \GusALN\TelegramBotApi\MethodRequests\SendChatActionRequest($userId, ChatAction::TYPING)
);

sleep(3);

$api->editMessageText(
    // The following comment is not required if you copy this snippet.
    // @phpstan-ignore-next-line
    new \GusALN\TelegramBotApi\MethodRequests\EditMessageTextRequest(
        chatId: $message->chat->id,
        messageId: $message->messageId,
        text: 'Darth Vader'
    )
);
