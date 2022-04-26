<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Contains information about why a request was unsuccessful.
 */
class ResponseParameters implements JsonSerializable
{
    /**
     * @param int|null $migrateToChatId Optional. The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @param int|null $retryAfter Optional. In case of exceeding flood control, the number of seconds left to wait before the request can be repeated
     */
    public function __construct(
        public ?int $migrateToChatId = null,
        public ?int $retryAfter = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['migrate_to_chat_id'] ?? null,
            $payload['retry_after'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'migrate_to_chat_id' => $this->migrateToChatId,
            'retry_after' => $this->retryAfter,
        ]);
    }
}