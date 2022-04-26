<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to unban a previously banned channel chat in a supergroup or channel. The bot must be an administrator for this to work and must have the appropriate administrator rights. Returns True on success.
 */
class UnbanChatSenderChatRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $senderChatId Unique identifier of the target sender chat
    */
    public function __construct(
        public int|string $chatId,
        public int $senderChatId,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['chat_id'],
            $payload['sender_chat_id'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'sender_chat_id' => $this->senderChatId,
        ]);
    }

    public function method(): string
    {
        return 'unbanChatSenderChat';
    }
}