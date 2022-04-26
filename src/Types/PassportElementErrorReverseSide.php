<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents an issue with the reverse side of a document. The error is considered resolved when the file with reverse side of the document changes.
 */
class PassportElementErrorReverseSide extends PassportElementError implements JsonSerializable
{
    private string $source = 'reverse_side';

    /**
     * @param string $type The section of the user's Telegram Passport which has the issue, one of "driver_license", "identity_card"
     * @param string $fileHash Base64-encoded hash of the file with the reverse side of the document
     * @param string $message Error message
     */
    public function __construct(
        public string $type,
        public string $fileHash,
        public string $message,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['type'],
            $payload['file_hash'],
            $payload['message'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'source' => $this->source,
            'type' => $this->type,
            'file_hash' => $this->fileHash,
            'message' => $this->message,
        ]);
    }

    /**
     * Error source, must be reverse_side.
     */
    public function source(): string
    {
        return $this->source;
    }
}