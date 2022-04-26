<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents the scope of bot commands, covering all group and supergroup chats.
 */
class BotCommandScopeAllGroupChats extends BotCommandScope implements JsonSerializable
{
    private string $type = 'all_group_chats';

    public function __construct()
    {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self();
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
        ]);
    }

    /**
     * Scope type, must be all_group_chats.
     */
    public function type(): string
    {
        return $this->type;
    }
}