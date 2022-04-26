<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\Chat;
use GusALN\TelegramBotApi\Types\ChatInviteLink;
use GusALN\TelegramBotApi\Types\ChatMember;
use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * This object represents changes in the status of a chat member.
 */
class ChatMemberUpdated implements JsonSerializable
{
    /**
     * @param Chat $chat Chat the user belongs to
     * @param User $from Performer of the action, which resulted in the change
     * @param int $date Date the change was done in Unix time
     * @param ChatMember $oldChatMember Previous information about the chat member
     * @param ChatMember $newChatMember New information about the chat member
     * @param ChatInviteLink|null $inviteLink Optional. Chat invite link, which was used by the user to join the chat; for joining by invite link events only.
     */
    public function __construct(
        public Chat $chat,
        public User $from,
        public int $date,
        public ChatMember $oldChatMember,
        public ChatMember $newChatMember,
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
            ChatMember::fromPayload($payload['old_chat_member']),
            ChatMember::fromPayload($payload['new_chat_member']),
            isset($payload['invite_link']) ? ChatInviteLink::fromPayload($payload['invite_link']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat' => $this->chat,
            'from' => $this->from,
            'date' => $this->date,
            'old_chat_member' => $this->oldChatMember,
            'new_chat_member' => $this->newChatMember,
            'invite_link' => $this->inviteLink,
        ]);
    }
}