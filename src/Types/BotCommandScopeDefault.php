<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents the default scope of bot commands. Default commands are used if no commands with a narrower scope are specified for the user.
 */
class BotCommandScopeDefault extends BotCommandScope implements JsonSerializable
{
    private string $type = 'default';

    public function __construct()
    {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
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
     * Scope type, must be default.
     */
    public function type(): string
    {
        return $this->type;
    }
}