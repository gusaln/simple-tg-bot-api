<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Describes that no specific value for the menu button was set.
 */
class MenuButtonDefault extends MenuButton implements JsonSerializable
{
    private string $type = 'default';

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
     * Type of the button, must be default.
     */
    public function type(): string
    {
        return $this->type;
    }
}