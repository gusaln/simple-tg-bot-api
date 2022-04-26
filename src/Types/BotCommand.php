<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a bot command.
 */
class BotCommand implements JsonSerializable
{
    /**
     * @param string $command Text of the command; 1-32 characters. Can contain only lowercase English letters, digits and underscores.
     * @param string $description Description of the command; 1-256 characters.
     */
    public function __construct(
        public string $command,
        public string $description,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['command'],
            $payload['description'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'command' => $this->command,
            'description' => $this->description,
        ]);
    }
}