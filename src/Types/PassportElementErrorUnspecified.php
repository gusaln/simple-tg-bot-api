<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents an issue in an unspecified place. The error is considered resolved when new data is added.
 */
class PassportElementErrorUnspecified extends PassportElementError implements JsonSerializable
{
    private string $source = 'unspecified';

    /**
     * @param string $type Type of element of the user's Telegram Passport which has the issue
     * @param string $elementHash Base64-encoded element hash
     * @param string $message Error message
     */
    public function __construct(
        public string $type,
        public string $elementHash,
        public string $message,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['type'],
            $payload['element_hash'],
            $payload['message'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'source' => $this->source,
            'type' => $this->type,
            'element_hash' => $this->elementHash,
            'message' => $this->message,
        ]);
    }

    /**
     * Error source, must be unspecified.
     */
    public function source(): string
    {
        return $this->source;
    }
}