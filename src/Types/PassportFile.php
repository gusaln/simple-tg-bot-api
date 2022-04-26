<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG format when decrypted and don't exceed 10MB.
 */
class PassportFile implements JsonSerializable
{
    /**
     * @param string $fileId Identifier for this file, which can be used to download or reuse the file
     * @param string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @param int $fileSize File size in bytes
     * @param int $fileDate Unix time when the file was uploaded
     */
    public function __construct(
        public string $fileId,
        public string $fileUniqueId,
        public int $fileSize,
        public int $fileDate,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['file_id'],
            $payload['file_unique_id'],
            $payload['file_size'],
            $payload['file_date'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'file_id' => $this->fileId,
            'file_unique_id' => $this->fileUniqueId,
            'file_size' => $this->fileSize,
            'file_date' => $this->fileDate,
        ]);
    }
}