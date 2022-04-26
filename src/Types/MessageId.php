<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a unique message identifier.
 */
class MessageId implements JsonSerializable
{
    /**
     * @param int $messageId Unique message identifier
     */
    public function __construct(
        public int $messageId,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['message_id'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'message_id' => $this->messageId,
        ]);
    }
}