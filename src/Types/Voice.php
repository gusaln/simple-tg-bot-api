<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a voice note.
 */
class Voice implements JsonSerializable
{
    /**
     * @param string $fileId Identifier for this file, which can be used to download or reuse the file
     * @param string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @param int $duration Duration of the audio in seconds as defined by sender
     * @param string|null $mimeType Optional. MIME type of the file as defined by sender
     * @param int|null $fileSize Optional. File size in bytes
     */
    public function __construct(
        public string $fileId,
        public string $fileUniqueId,
        public int $duration,
        public ?string $mimeType = null,
        public ?int $fileSize = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['file_id'],
            $payload['file_unique_id'],
            $payload['duration'],
            $payload['mime_type'] ?? null,
            $payload['file_size'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'file_id' => $this->fileId,
            'file_unique_id' => $this->fileUniqueId,
            'duration' => $this->duration,
            'mime_type' => $this->mimeType,
            'file_size' => $this->fileSize,
        ]);
    }
}