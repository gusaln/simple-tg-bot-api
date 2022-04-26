<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to unban a previously banned user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it. So if the user is a member of the chat they will also be removed from the chat. If you don't want this, use the parameter only_if_banned. Returns True on success.
 */
class UnbanChatMemberRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target group or username of the target supergroup or channel (in the format @channelusername)
     * @param int $userId Unique identifier of the target user
     * @param bool|null $onlyIfBanned Do nothing if the user is not banned
    */
    public function __construct(
        public int|string $chatId,
        public int $userId,
        public ?bool $onlyIfBanned = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['chat_id'],
            $payload['user_id'],
            $payload['only_if_banned'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'user_id' => $this->userId,
            'only_if_banned' => $this->onlyIfBanned,
        ]);
    }

    public function method(): string
    {
        return 'unbanChatMember';
    }
}