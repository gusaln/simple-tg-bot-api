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

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
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