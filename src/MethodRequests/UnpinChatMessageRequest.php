<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to remove a message from the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel. Returns True on success.
 */
class UnpinChatMessageRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $messageId Identifier of a message to unpin. If not specified, the most recent pinned message (by sending date) will be unpinned.
    */
    public function __construct(
        public int|string $chatId,
        public ?int $messageId = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'],
            $payload['message_id'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
        ]);
    }

    public function method(): string
    {
        return 'unpinChatMessage';
    }
}