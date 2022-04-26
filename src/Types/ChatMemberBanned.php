<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * Represents a chat member that was banned in the chat and can't return to the chat or view chat messages.
 */
class ChatMemberBanned extends ChatMember implements JsonSerializable
{
    private string $status = 'kicked';

    /**
     * @param User $user Information about the user
     * @param int $untilDate Date when restrictions will be lifted for this user; unix time. If 0, then the user is banned forever
     */
    public function __construct(
        public User $user,
        public int $untilDate,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            User::fromPayload($payload['user']),
            $payload['until_date'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'status' => $this->status,
            'user' => $this->user,
            'until_date' => $this->untilDate,
        ]);
    }

    /**
     * The member's status in the chat, always "kicked".
     */
    public function status(): string
    {
        return $this->status;
    }
}