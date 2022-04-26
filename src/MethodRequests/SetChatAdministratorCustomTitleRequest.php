<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns True on success.
 */
class SetChatAdministratorCustomTitleRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $userId Unique identifier of the target user
     * @param string $customTitle New custom title for the administrator; 0-16 characters, emoji are not allowed
    */
    public function __construct(
        public int|string $chatId,
        public int $userId,
        public string $customTitle,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'],
            $payload['user_id'],
            $payload['custom_title'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'user_id' => $this->userId,
            'custom_title' => $this->customTitle,
        ]);
    }

    public function method(): string
    {
        return 'setChatAdministratorCustomTitle';
    }
}