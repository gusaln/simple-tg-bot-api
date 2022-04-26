<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to get the current value of the bot's menu button in a private chat, or the default menu button. Returns MenuButton on success.
 */
class GetChatMenuButtonRequest extends MethodRequest
{
    /**
     * @param int|null $chatId Unique identifier for the target private chat. If not specified, default bot's menu button will be returned
    */
    public function __construct(
        public ?int $chatId = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
        ]);
    }

    public function method(): string
    {
        return 'getChatMenuButton';
    }
}