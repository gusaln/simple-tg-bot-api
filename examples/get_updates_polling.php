<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

// Replace the following
$token = '<insert token>';

$api = new \GusALN\TelegramBotApi\BotApi(
    $token,
    client: new \GusALN\TelegramBotApi\Client\GuzzleClient()
);

// This loop will consume batches of 10 updates until no more updates are found. As explained in
// the documentation, you can provide an offset to the getUpdates method, and Update with an
// updateId lower than `offset` will not be sent again, even when no offset is provided.
$lastUpdateId = -1;
$updates = $api->getUpdates(new \GusALN\TelegramBotApi\MethodRequests\GetUpdatesRequest(limit: 10));
while (! empty($updates)) {
    foreach ($updates as $update) {
        echo json_encode($update, JSON_PRETTY_PRINT).PHP_EOL;
        $lastUpdateId = $update->updateId;
    }

    $updates = $api->getUpdates(new \GusALN\TelegramBotApi\MethodRequests\GetUpdatesRequest(offset: $lastUpdateId + 1, limit: 10));
}
