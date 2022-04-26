<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * A placeholder, currently holds no information. Use BotFather to set up your game.
 */
class CallbackGame implements JsonSerializable
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