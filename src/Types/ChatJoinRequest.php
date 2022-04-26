<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\Chat;
use GusALN\TelegramBotApi\Types\ChatInviteLink;
use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * Represents a join request sent to a chat.
 */
class ChatJoinRequest implements JsonSerializable
{
    /**
     * @param Chat $chat Chat to which the request was sent
     * @param User $from User that sent the join request
     * @param int $date Date the request was sent in Unix time
     * @param string|null $bio Optional. Bio of the user.
     * @param ChatInviteLink|null $inviteLink Optional. Chat invite link that was used by the user to send the join request
     */
    public function __construct(
        public Chat $chat,
        public User $from,
        public int $date,
        public ?string $bio = null,
        public ?ChatInviteLink $inviteLink = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            Chat::fromPayload($payload['chat']),
            User::fromPayload($payload['from']),
            $payload['date'],
            $payload['bio'] ?? null,
            isset($payload['invite_link']) ? ChatInviteLink::fromPayload($payload['invite_link']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat' => $this->chat,
            'from' => $this->from,
            'date' => $this->date,
            'bio' => $this->bio,
            'invite_link' => $this->inviteLink,
        ]);
    }
}