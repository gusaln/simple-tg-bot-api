<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * A simple method for testing your bot's authentication token. Requires no parameters. Returns basic information about the bot in form of a User object.
 */
class GetMeRequest extends MethodRequest
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
        return 'getMe';
    }
}