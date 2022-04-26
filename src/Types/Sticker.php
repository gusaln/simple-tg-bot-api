<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\MaskPosition;
use GusALN\TelegramBotApi\Types\PhotoSize;
use JsonSerializable;

/**
 * This object represents a sticker.
 */
class Sticker implements JsonSerializable
{
    /**
     * @param string $fileId Identifier for this file, which can be used to download or reuse the file
     * @param string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @param int $width Sticker width
     * @param int $height Sticker height
     * @param bool $isAnimated True, if the sticker is animated
     * @param bool $isVideo True, if the sticker is a video sticker
     * @param PhotoSize|null $thumb Optional. Sticker thumbnail in the .WEBP or .JPG format
     * @param string|null $emoji Optional. Emoji associated with the sticker
     * @param string|null $setName Optional. Name of the sticker set to which the sticker belongs
     * @param MaskPosition|null $maskPosition Optional. For mask stickers, the position where the mask should be placed
     * @param int|null $fileSize Optional. File size in bytes
     */
    public function __construct(
        public string $fileId,
        public string $fileUniqueId,
        public int $width,
        public int $height,
        public bool $isAnimated,
        public bool $isVideo,
        public ?PhotoSize $thumb = null,
        public ?string $emoji = null,
        public ?string $setName = null,
        public ?MaskPosition $maskPosition = null,
        public ?int $fileSize = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['file_id'],
            $payload['file_unique_id'],
            $payload['width'],
            $payload['height'],
            $payload['is_animated'],
            $payload['is_video'],
            isset($payload['thumb']) ? PhotoSize::fromPayload($payload['thumb']) : null,
            $payload['emoji'] ?? null,
            $payload['set_name'] ?? null,
            isset($payload['mask_position']) ? MaskPosition::fromPayload($payload['mask_position']) : null,
            $payload['file_size'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'file_id' => $this->fileId,
            'file_unique_id' => $this->fileUniqueId,
            'width' => $this->width,
            'height' => $this->height,
            'is_animated' => $this->isAnimated,
            'is_video' => $this->isVideo,
            'thumb' => $this->thumb,
            'emoji' => $this->emoji,
            'set_name' => $this->setName,
            'mask_position' => $this->maskPosition,
            'file_size' => $this->fileSize,
        ]);
    }
}