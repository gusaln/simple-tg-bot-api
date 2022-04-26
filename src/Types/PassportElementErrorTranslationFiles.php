<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents an issue with the translated version of a document. The error is considered resolved when a file with the document translation change.
 */
class PassportElementErrorTranslationFiles extends PassportElementError implements JsonSerializable
{
    private string $source = 'translation_files';

    /**
     * @param string $type Type of element of the user's Telegram Passport which has the issue, one of "passport", "driver_license", "identity_card", "internal_passport", "utility_bill", "bank_statement", "rental_agreement", "passport_registration", "temporary_registration"
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
     * Error source, must be translation_files.
     */
    public function source(): string
    {
        return $this->source;
    }
}