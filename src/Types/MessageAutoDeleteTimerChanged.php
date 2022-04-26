<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a service message about a change in auto-delete timer settings.
 */
class MessageAutoDeleteTimerChanged implements JsonSerializable
{
    /**
     * @param int $messageAutoDeleteTime New auto-delete time for messages in the chat; in seconds
     */
    public function __construct(
        public int $messageAutoDeleteTime,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['message_auto_delete_time'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'message_auto_delete_time' => $this->messageAutoDeleteTime,
        ]);
    }
}