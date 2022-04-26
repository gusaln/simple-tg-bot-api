<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents an animated emoji that displays a random value.
 */
class Dice implements JsonSerializable
{
    /**
     * @param string $emoji Emoji on which the dice throw animation is based
     * @param int $value Value of the dice, 1-6 for "", "" and "" base emoji, 1-5 for "" and "" base emoji, 1-64 for "" base emoji
     */
    public function __construct(
        public string $emoji,
        public int $value,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['emoji'],
            $payload['value'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'emoji' => $this->emoji,
            'value' => $this->value,
        ]);
    }
}