<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\ChatPermissions;

/**
 * Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members administrator rights. Returns True on success.
 */
class SetChatPermissionsRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param ChatPermissions $permissions A JSON-serialized object for new default chat permissions
    */
    public function __construct(
        public int|string $chatId,
        public ChatPermissions $permissions,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'],
            ChatPermissions::fromPayload($payload['permissions']),
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'permissions' => $this->permissions,
        ]);
    }

    public function method(): string
    {
        return 'setChatPermissions';
    }
}