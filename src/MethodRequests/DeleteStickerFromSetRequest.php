<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to delete a sticker from a set created by the bot. Returns True on success.
 */
class DeleteStickerFromSetRequest extends MethodRequest
{
    /**
     * @param string $sticker File identifier of the sticker
    */
    public function __construct(
        public string $sticker,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['sticker'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'sticker' => $this->sticker,
        ]);
    }

    public function method(): string
    {
        return 'deleteStickerFromSet';
    }
}