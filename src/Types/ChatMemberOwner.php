<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * Represents a chat member that owns the chat and has all administrator privileges.
 */
class ChatMemberOwner extends ChatMember implements JsonSerializable
{
    private string $status = 'creator';

    /**
     * @param User $user Information about the user
     * @param bool $isAnonymous True, if the user's presence in the chat is hidden
     * @param string|null $customTitle Optional. Custom title for this user
     */
    public function __construct(
        public User $user,
        public bool $isAnonymous,
        public ?string $customTitle = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            User::fromPayload($payload['user']),
            $payload['is_anonymous'],
            $payload['custom_title'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'status' => $this->status,
            'user' => $this->user,
            'is_anonymous' => $this->isAnonymous,
            'custom_title' => $this->customTitle,
        ]);
    }

    /**
     * The member's status in the chat, always "creator".
     */
    public function status(): string
    {
        return $this->status;
    }
}