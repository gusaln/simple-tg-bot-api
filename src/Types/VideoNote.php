<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\PhotoSize;
use JsonSerializable;

/**
 * This object represents a video message (available in Telegram apps as of v.4.0).
 */
class VideoNote implements JsonSerializable
{
    /**
     * @param string $fileId Identifier for this file, which can be used to download or reuse the file
     * @param string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @param int $length Video width and height (diameter of the video message) as defined by sender
     * @param int $duration Duration of the video in seconds as defined by sender
     * @param PhotoSize|null $thumb Optional. Video thumbnail
     * @param int|null $fileSize Optional. File size in bytes
     */
    public function __construct(
        public string $fileId,
        public string $fileUniqueId,
        public int $length,
        public int $duration,
        public ?PhotoSize $thumb = null,
        public ?int $fileSize = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['file_id'],
            $payload['file_unique_id'],
            $payload['length'],
            $payload['duration'],
            isset($payload['thumb']) ? PhotoSize::fromPayload($payload['thumb']) : null,
            $payload['file_size'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'file_id' => $this->fileId,
            'file_unique_id' => $this->fileUniqueId,
            'length' => $this->length,
            'duration' => $this->duration,
            'thumb' => $this->thumb,
            'file_size' => $this->fileSize,
        ]);
    }
}