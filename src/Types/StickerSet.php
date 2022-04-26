<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\PhotoSize;
use GusALN\TelegramBotApi\Types\Sticker;
use JsonSerializable;

/**
 * This object represents a sticker set.
 */
class StickerSet implements JsonSerializable
{
    /**
     * @param string $name Sticker set name
     * @param string $title Sticker set title
     * @param bool $isAnimated True, if the sticker set contains animated stickers
     * @param bool $isVideo True, if the sticker set contains video stickers
     * @param bool $containsMasks True, if the sticker set contains masks
     * @param Sticker[] $stickers List of all set stickers
     * @param PhotoSize|null $thumb Optional. Sticker set thumbnail in the .WEBP, .TGS, or .WEBM format
     */
    public function __construct(
        public string $name,
        public string $title,
        public bool $isAnimated,
        public bool $isVideo,
        public bool $containsMasks,
        public array $stickers,
        public ?PhotoSize $thumb = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['name'],
            $payload['title'],
            $payload['is_animated'],
            $payload['is_video'],
            $payload['contains_masks'],
            array_map(fn($t) => Sticker::fromPayload($t), $payload['stickers']),
            isset($payload['thumb']) ? PhotoSize::fromPayload($payload['thumb']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'name' => $this->name,
            'title' => $this->title,
            'is_animated' => $this->isAnimated,
            'is_video' => $this->isVideo,
            'contains_masks' => $this->containsMasks,
            'stickers' => $this->stickers,
            'thumb' => $this->thumb,
        ]);
    }
}