<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a service message about a video chat scheduled in the chat.
 */
class VideoChatScheduled implements JsonSerializable
{
    /**
     * @param int $startDate Point in time (Unix timestamp) when the video chat is supposed to be started by a chat administrator
     */
    public function __construct(
        public int $startDate,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['start_date'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'start_date' => $this->startDate,
        ]);
    }
}