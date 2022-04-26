<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InputFile;

/**
 * Use this method to set the thumbnail of a sticker set. Animated thumbnails can be set for animated sticker sets only. Video thumbnails can be set only for video sticker sets only. Returns True on success.
 */
class SetStickerSetThumbRequest extends MethodRequest
{
    /**
     * @param string $name Sticker set name
     * @param int $userId User identifier of the sticker set owner
     * @param InputFile|string|null $thumb A PNG image with the thumbnail, must be up to 128 kilobytes in size and have width and height exactly 100px, or a TGS animation with the thumbnail up to 32 kilobytes in size; see https://core.telegram.org/stickers#animated-sticker-requirements for animated sticker technical requirements, or a WEBM video with the thumbnail up to 32 kilobytes in size; see https://core.telegram.org/stickers#video-sticker-requirements for video sticker technical requirements. Pass a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files ». Animated sticker set thumbnails can't be uploaded via HTTP URL.
    */
    public function __construct(
        public string $name,
        public int $userId,
        public InputFile|string|null $thumb = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['name'],
            $payload['user_id'],
            $payload['thumb'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'name' => $this->name,
            'user_id' => $this->userId,
            'thumb' => $this->thumb,
        ]);
    }

    public function method(): string
    {
        return 'setStickerSetThumb';
    }
}