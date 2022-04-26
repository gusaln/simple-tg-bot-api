<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will display unsupported message.
 */
class InlineKeyboardMarkup implements JsonSerializable
{
    /**
     * @param array[] $inlineKeyboard Array of button rows, each represented by an Array of InlineKeyboardButton objects
     */
    public function __construct(
        public array $inlineKeyboard,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['inline_keyboard'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'inline_keyboard' => $this->inlineKeyboard,
        ]);
    }
}