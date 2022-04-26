<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents a menu button, which opens the bot's list of commands.
 */
class MenuButtonCommands extends MenuButton implements JsonSerializable
{
    private string $type = 'commands';

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
     * Type of the button, must be commands.
     */
    public function type(): string
    {
        return $this->type;
    }
}