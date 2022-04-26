<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to move a sticker in a set created by the bot to a specific position. Returns True on success.
 */
class SetStickerPositionInSetRequest extends MethodRequest
{
    /**
     * @param string $sticker File identifier of the sticker
     * @param int $position New sticker position in the set, zero-based
    */
    public function __construct(
        public string $sticker,
        public int $position,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['sticker'],
            $payload['position'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'sticker' => $this->sticker,
            'position' => $this->position,
        ]);
    }

    public function method(): string
    {
        return 'setStickerPositionInSet';
    }
}