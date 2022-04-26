<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents an issue with a list of scans. The error is considered resolved when the list of files containing the scans changes.
 */
class PassportElementErrorFiles extends PassportElementError implements JsonSerializable
{
    private string $source = 'files';

    /**
     * @param string $type The section of the user's Telegram Passport which has the issue, one of "utility_bill", "bank_statement", "rental_agreement", "passport_registration", "temporary_registration"
     * @param string[] $fileHashes List of base64-encoded file hashes
     * @param string $message Error message
     */
    public function __construct(
        public string $type,
        public array $fileHashes,
        public string $message,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['type'],
            $payload['file_hashes'],
            $payload['message'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'source' => $this->source,
            'type' => $this->type,
            'file_hashes' => $this->fileHashes,
            'message' => $this->message,
        ]);
    }

    /**
     * Error source, must be files.
     */
    public function source(): string
    {
        return $this->source;
    }
}