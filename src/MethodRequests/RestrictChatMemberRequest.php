<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\ChatPermissions;

/**
 * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights. Pass True for all permissions to lift restrictions from a user. Returns True on success.
 */
class RestrictChatMemberRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $userId Unique identifier of the target user
     * @param ChatPermissions $permissions A JSON-serialized object for new user permissions
     * @param int|null $untilDate Date when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or less than 30 seconds from the current time, they are considered to be restricted forever
    */
    public function __construct(
        public int|string $chatId,
        public int $userId,
        public ChatPermissions $permissions,
        public ?int $untilDate = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'],
            $payload['user_id'],
            ChatPermissions::fromPayload($payload['permissions']),
            $payload['until_date'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'user_id' => $this->userId,
            'permissions' => $this->permissions,
            'until_date' => $this->untilDate,
        ]);
    }

    public function method(): string
    {
        return 'restrictChatMember';
    }
}