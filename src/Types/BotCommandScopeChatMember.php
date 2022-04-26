<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents the scope of bot commands, covering a specific member of a group or supergroup chat.
 */
class BotCommandScopeChatMember extends BotCommandScope implements JsonSerializable
{
    private string $type = 'chat_member';

    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target supergroup (in the format @supergroupusername)
     * @param int $userId Unique identifier of the target user
     */
    public function __construct(
        public int|string $chatId,
        public int $userId,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['chat_id'],
            $payload['user_id'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'chat_id' => $this->chatId,
            'user_id' => $this->userId,
        ]);
    }

    /**
     * Scope type, must be chat_member.
     */
    public function type(): string
    {
        return $this->type;
    }
}