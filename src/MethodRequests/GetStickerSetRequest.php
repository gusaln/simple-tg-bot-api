<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to get a sticker set. On success, a StickerSet object is returned.
 */
class GetStickerSetRequest extends MethodRequest
{
    /**
     * @param string $name Name of the sticker set
    */
    public function __construct(
        public string $name,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['name'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'name' => $this->name,
        ]);
    }

    public function method(): string
    {
        return 'getStickerSet';
    }
}