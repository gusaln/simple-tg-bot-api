<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * Represents a chat member that is under certain restrictions in the chat. Supergroups only.
 */
class ChatMemberRestricted extends ChatMember implements JsonSerializable
{
    private string $status = 'restricted';

    /**
     * @param User $user Information about the user
     * @param bool $isMember True, if the user is a member of the chat at the moment of the request
     * @param bool $canChangeInfo True, if the user is allowed to change the chat title, photo and other settings
     * @param bool $canInviteUsers True, if the user is allowed to invite new users to the chat
     * @param bool $canPinMessages True, if the user is allowed to pin messages
     * @param bool $canSendMessages True, if the user is allowed to send text messages, contacts, locations and venues
     * @param bool $canSendMediaMessages True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes
     * @param bool $canSendPolls True, if the user is allowed to send polls
     * @param bool $canSendOtherMessages True, if the user is allowed to send animations, games, stickers and use inline bots
     * @param bool $canAddWebPagePreviews True, if the user is allowed to add web page previews to their messages
     * @param int $untilDate Date when restrictions will be lifted for this user; unix time. If 0, then the user is restricted forever
     */
    public function __construct(
        public User $user,
        public bool $isMember,
        public bool $canChangeInfo,
        public bool $canInviteUsers,
        public bool $canPinMessages,
        public bool $canSendMessages,
        public bool $canSendMediaMessages,
        public bool $canSendPolls,
        public bool $canSendOtherMessages,
        public bool $canAddWebPagePreviews,
        public int $untilDate,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            User::fromPayload($payload['user']),
            $payload['is_member'],
            $payload['can_change_info'],
            $payload['can_invite_users'],
            $payload['can_pin_messages'],
            $payload['can_send_messages'],
            $payload['can_send_media_messages'],
            $payload['can_send_polls'],
            $payload['can_send_other_messages'],
            $payload['can_add_web_page_previews'],
            $payload['until_date'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'status' => $this->status,
            'user' => $this->user,
            'is_member' => $this->isMember,
            'can_change_info' => $this->canChangeInfo,
            'can_invite_users' => $this->canInviteUsers,
            'can_pin_messages' => $this->canPinMessages,
            'can_send_messages' => $this->canSendMessages,
            'can_send_media_messages' => $this->canSendMediaMessages,
            'can_send_polls' => $this->canSendPolls,
            'can_send_other_messages' => $this->canSendOtherMessages,
            'can_add_web_page_previews' => $this->canAddWebPagePreviews,
            'until_date' => $this->untilDate,
        ]);
    }

    /**
     * The member's status in the chat, always "restricted".
     */
    public function status(): string
    {
        return $this->status;
    }
}