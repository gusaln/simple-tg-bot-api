<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * This object represents the content of a service message, sent whenever a user in the chat triggers a proximity alert set by another user.
 */
class ProximityAlertTriggered implements JsonSerializable
{
    /**
     * @param User $traveler User that triggered the alert
     * @param User $watcher User that set the alert
     * @param int $distance The distance between the users
     */
    public function __construct(
        public User $traveler,
        public User $watcher,
        public int $distance,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            User::fromPayload($payload['traveler']),
            User::fromPayload($payload['watcher']),
            $payload['distance'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'traveler' => $this->traveler,
            'watcher' => $this->watcher,
            'distance' => $this->distance,
        ]);
    }
}