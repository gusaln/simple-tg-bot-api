<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InputFile;

/**
 * Use this method to upload a .PNG file with a sticker for later use in createNewStickerSet and addStickerToSet methods (can be used multiple times). Returns the uploaded File on success.
 */
class UploadStickerFileRequest extends MethodRequest
{
    /**
     * @param int $userId User identifier of sticker file owner
     * @param InputFile $pngSticker PNG image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px. More info on Sending Files »
    */
    public function __construct(
        public int $userId,
        public InputFile $pngSticker,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['user_id'],
            InputFile::fromPayload($payload['png_sticker']),
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'user_id' => $this->userId,
            'png_sticker' => $this->pngSticker,
        ]);
    }

    public function method(): string
    {
        return 'uploadStickerFile';
    }
}