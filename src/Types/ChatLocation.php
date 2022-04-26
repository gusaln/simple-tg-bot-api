<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\Location;
use JsonSerializable;

/**
 * Represents a location to which a chat is connected.
 */
class ChatLocation implements JsonSerializable
{
    /**
     * @param Location $location The location to which the supergroup is connected. Can't be a live location.
     * @param string $address Location address; 1-64 characters, as defined by the chat owner
     */
    public function __construct(
        public Location $location,
        public string $address,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            Location::fromPayload($payload['location']),
            $payload['address'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'location' => $this->location,
            'address' => $this->address,
        ]);
    }
}