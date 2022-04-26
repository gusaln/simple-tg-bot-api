<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Contains information about an inline message sent by a Web App on behalf of a user.
 */
class SentWebAppMessage implements JsonSerializable
{
    /**
     * @param string|null $inlineMessageId Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message.
     */
    public function __construct(
        public ?string $inlineMessageId = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['inline_message_id'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'inline_message_id' => $this->inlineMessageId,
        ]);
    }
}