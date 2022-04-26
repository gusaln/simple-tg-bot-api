<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\MessageEntity;
use JsonSerializable;

/**
 * Represents the content of a text message to be sent as the result of an inline query.
 */
class InputTextMessageContent extends InputMessageContent implements JsonSerializable
{
    /**
     * @param string $messageText Text of the message to be sent, 1-4096 characters
     * @param string|null $parseMode Optional. Mode for parsing entities in the message text. See formatting options for more details.
     * @param MessageEntity[]|null $entities Optional. List of special entities that appear in message text, which can be specified instead of parse_mode
     * @param bool|null $disableWebPagePreview Optional. Disables link previews for links in the sent message
     */
    public function __construct(
        public string $messageText,
        public ?string $parseMode = null,
        public ?array $entities = null,
        public ?bool $disableWebPagePreview = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['message_text'],
            $payload['parse_mode'] ?? null,
            isset($payload['entities']) ? array_map(fn($t) => MessageEntity::fromPayload($t), $payload['entities']) : null,
            $payload['disable_web_page_preview'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'message_text' => $this->messageText,
            'parse_mode' => $this->parseMode,
            'entities' => $this->entities,
            'disable_web_page_preview' => $this->disableWebPagePreview,
        ]);
    }
}