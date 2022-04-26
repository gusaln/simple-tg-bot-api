<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a service message about a video chat ended in the chat.
 */
class VideoChatEnded implements JsonSerializable
{
    /**
     * @param int $duration Video chat duration in seconds
     */
    public function __construct(
        public int $duration,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['duration'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'duration' => $this->duration,
        ]);
    }
}