<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Contains data sent from a Web App to the bot.
 */
class WebAppData implements JsonSerializable
{
    /**
     * @param string $data The data. Be aware that a bad client can send arbitrary data in this field.
     * @param string $buttonText Text of the web_app keyboard button, from which the Web App was opened. Be aware that a bad client can send arbitrary data in this field.
     */
    public function __construct(
        public string $data,
        public string $buttonText,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['data'],
            $payload['button_text'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'data' => $this->data,
            'button_text' => $this->buttonText,
        ]);
    }
}