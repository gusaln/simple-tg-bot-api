<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if the user has selected the bot's message and tapped 'Reply'). This can be extremely useful if you want to create user-friendly step-by-step interfaces without having to sacrifice privacy mode.
 */
class ForceReply implements JsonSerializable
{
    /**
     * @param bool $forceReply Shows reply interface to the user, as if they manually selected the bot's message and tapped 'Reply'
     * @param string|null $inputFieldPlaceholder Optional. The placeholder to be shown in the input field when the reply is active; 1-64 characters
     * @param bool|null $selective Optional. Use this parameter if you want to force reply from specific users only. Targets: 1) users that are @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id), sender of the original message.
     */
    public function __construct(
        public bool $forceReply,
        public ?string $inputFieldPlaceholder = null,
        public ?bool $selective = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['force_reply'],
            $payload['input_field_placeholder'] ?? null,
            $payload['selective'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'force_reply' => $this->forceReply,
            'input_field_placeholder' => $this->inputFieldPlaceholder,
            'selective' => $this->selective,
        ]);
    }
}