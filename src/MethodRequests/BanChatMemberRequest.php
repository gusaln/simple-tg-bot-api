<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
 */
class BanChatMemberRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target group or username of the target supergroup or channel (in the format @channelusername)
     * @param int $userId Unique identifier of the target user
     * @param int|null $untilDate Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever. Applied for supergroups and channels only.
     * @param bool|null $revokeMessages Pass True to delete all messages from the chat for the user that is being removed. If False, the user will be able to see messages in the group that were sent before the user was removed. Always True for supergroups and channels.
    */
    public function __construct(
        public int|string $chatId,
        public int $userId,
        public ?int $untilDate = null,
        public ?bool $revokeMessages = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'],
            $payload['user_id'],
            $payload['until_date'] ?? null,
            $payload['revoke_messages'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'user_id' => $this->userId,
            'until_date' => $this->untilDate,
            'revoke_messages' => $this->revokeMessages,
        ]);
    }

    public function method(): string
    {
        return 'banChatMember';
    }
}