<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InputFile;
use GusALN\TelegramBotApi\Types\MaskPosition;

/**
 * Use this method to create a new sticker set owned by a user. The bot will be able to edit the sticker set thus created. You must use exactly one of the fields png_sticker, tgs_sticker, or webm_sticker. Returns True on success.
 */
class CreateNewStickerSetRequest extends MethodRequest
{
    /**
     * @param int $userId User identifier of created sticker set owner
     * @param string $name Short name of sticker set, to be used in t.me/addstickers/ URLs (e.g., animals). Can contain only english letters, digits and underscores. Must begin with a letter, can't contain consecutive underscores and must end in "_by_<bot_username>". <bot_username> is case insensitive. 1-64 characters.
     * @param string $title Sticker set title, 1-64 characters
     * @param InputFile|string|null $pngSticker PNG image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px. Pass a file_id as a String to send a file that already exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data. More info on Sending Files »
     * @param InputFile|null $tgsSticker TGS animation with the sticker, uploaded using multipart/form-data. See https://core.telegram.org/stickers#animated-sticker-requirements for technical requirements
     * @param InputFile|null $webmSticker WEBM video with the sticker, uploaded using multipart/form-data. See https://core.telegram.org/stickers#video-sticker-requirements for technical requirements
     * @param string $emojis One or more emoji corresponding to the sticker
     * @param bool|null $containsMasks Pass True, if a set of mask stickers should be created
     * @param MaskPosition|null $maskPosition A JSON-serialized object for position where the mask should be placed on faces
    */
    public function __construct(
        public int $userId,
        public string $name,
        public string $title,
        public InputFile|string|null $pngSticker = null,
        public ?InputFile $tgsSticker = null,
        public ?InputFile $webmSticker = null,
        public string $emojis,
        public ?bool $containsMasks = null,
        public ?MaskPosition $maskPosition = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['user_id'],
            $payload['name'],
            $payload['title'],
            $payload['png_sticker'] ?? null,
            isset($payload['tgs_sticker']) ? InputFile::fromPayload($payload['tgs_sticker']) : null,
            isset($payload['webm_sticker']) ? InputFile::fromPayload($payload['webm_sticker']) : null,
            $payload['emojis'],
            $payload['contains_masks'] ?? null,
            isset($payload['mask_position']) ? MaskPosition::fromPayload($payload['mask_position']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'user_id' => $this->userId,
            'name' => $this->name,
            'title' => $this->title,
            'png_sticker' => $this->pngSticker,
            'tgs_sticker' => $this->tgsSticker,
            'webm_sticker' => $this->webmSticker,
            'emojis' => $this->emojis,
            'contains_masks' => $this->containsMasks,
            'mask_position' => $this->maskPosition,
        ]);
    }

    public function method(): string
    {
        return 'createNewStickerSet';
    }
}