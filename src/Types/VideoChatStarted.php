<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a service message about a video chat started in the chat. Currently holds no information.
 */
class VideoChatStarted implements JsonSerializable
{
    public function __construct()
    {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self();
    }

    public function jsonSerialize(): mixed
    {
        return [];
    }
}