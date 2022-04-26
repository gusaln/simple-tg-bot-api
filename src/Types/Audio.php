<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\PhotoSize;
use JsonSerializable;

/**
 * This object represents an audio file to be treated as music by the Telegram clients.
 */
class Audio implements JsonSerializable
{
    /**
     * @param string $fileId Identifier for this file, which can be used to download or reuse the file
     * @param string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @param int $duration Duration of the audio in seconds as defined by sender
     * @param string|null $performer Optional. Performer of the audio as defined by sender or by audio tags
     * @param string|null $title Optional. Title of the audio as defined by sender or by audio tags
     * @param string|null $fileName Optional. Original filename as defined by sender
     * @param string|null $mimeType Optional. MIME type of the file as defined by sender
     * @param int|null $fileSize Optional. File size in bytes
     * @param PhotoSize|null $thumb Optional. Thumbnail of the album cover to which the music file belongs
     */
    public function __construct(
        public string $fileId,
        public string $fileUniqueId,
        public int $duration,
        public ?string $performer = null,
        public ?string $title = null,
        public ?string $fileName = null,
        public ?string $mimeType = null,
        public ?int $fileSize = null,
        public ?PhotoSize $thumb = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['file_id'],
            $payload['file_unique_id'],
            $payload['duration'],
            $payload['performer'] ?? null,
            $payload['title'] ?? null,
            $payload['file_name'] ?? null,
            $payload['mime_type'] ?? null,
            $payload['file_size'] ?? null,
            isset($payload['thumb']) ? PhotoSize::fromPayload($payload['thumb']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'file_id' => $this->fileId,
            'file_unique_id' => $this->fileUniqueId,
            'duration' => $this->duration,
            'performer' => $this->performer,
            'title' => $this->title,
            'file_name' => $this->fileName,
            'mime_type' => $this->mimeType,
            'file_size' => $this->fileSize,
            'thumb' => $this->thumb,
        ]);
    }
}