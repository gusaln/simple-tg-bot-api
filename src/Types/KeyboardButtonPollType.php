<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents type of a poll, which is allowed to be created and sent when the corresponding button is pressed.
 */
class KeyboardButtonPollType implements JsonSerializable
{
    /**
     * @param string|null $type Optional. If quiz is passed, the user will be allowed to create only polls in the quiz mode. If regular is passed, only regular polls will be allowed. Otherwise, the user will be allowed to create a poll of any type.
     */
    public function __construct(
        public ?string $type = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['type'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
        ]);
    }
}