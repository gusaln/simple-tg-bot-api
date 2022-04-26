<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * This object represents a service message about new members invited to a video chat.
 */
class VideoChatParticipantsInvited implements JsonSerializable
{
    /**
     * @param User[] $users New members that were invited to the video chat
     */
    public function __construct(
        public array $users,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            array_map(fn($t) => User::fromPayload($t), $payload['users']),
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'users' => $this->users,
        ]);
    }
}