<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to get information about a member of a chat. Returns a ChatMember object on success.
 */
class GetChatMemberRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target supergroup or channel (in the format @channelusername)
     * @param int $userId Unique identifier of the target user
    */
    public function __construct(
        public int|string $chatId,
        public int $userId,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['chat_id'],
            $payload['user_id'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'user_id' => $this->userId,
        ]);
    }

    public function method(): string
    {
        return 'getChatMember';
    }
}