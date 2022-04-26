<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If the bot is using getUpdates, will return an object with the url field empty.
 */
class GetWebhookInfoRequest extends MethodRequest
{
    public function __construct()
    {
    }

    public static function fromPayload(array $payload): static
    {
        return new self();
    }


    public function jsonSerialize(): mixed
    {
        return [];
    }

    public function method(): string
    {
        return 'getWebhookInfo';
    }
}