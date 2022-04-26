<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
 */
class DeleteChatPhotoRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
    */
    public function __construct(
        public int|string $chatId,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'],
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
        return 'deleteChatPhoto';
    }
}