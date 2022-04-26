<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * Represents a chat member that isn't currently a member of the chat, but may join it themselves.
 */
class ChatMemberLeft extends ChatMember implements JsonSerializable
{
    private string $status = 'left';

    /**
     * @param User $user Information about the user
     */
    public function __construct(
        public User $user,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            User::fromPayload($payload['user']),
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'status' => $this->status,
            'user' => $this->user,
        ]);
    }

    /**
     * The member's status in the chat, always "left".
     */
    public function status(): string
    {
        return $this->status;
    }
}