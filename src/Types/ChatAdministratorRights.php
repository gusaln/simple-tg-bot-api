<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents the rights of an administrator in a chat.
 */
class ChatAdministratorRights implements JsonSerializable
{
    /**
     * @param bool $isAnonymous True, if the user's presence in the chat is hidden
     * @param bool $canManageChat True, if the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
     * @param bool $canDeleteMessages True, if the administrator can delete messages of other users
     * @param bool $canManageVideoChats True, if the administrator can manage video chats
     * @param bool $canRestrictMembers True, if the administrator can restrict, ban or unban chat members
     * @param bool $canPromoteMembers True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user)
     * @param bool $canChangeInfo True, if the user is allowed to change the chat title, photo and other settings
     * @param bool $canInviteUsers True, if the user is allowed to invite new users to the chat
     * @param bool|null $canPostMessages Optional. True, if the administrator can post in the channel; channels only
     * @param bool|null $canEditMessages Optional. True, if the administrator can edit messages of other users and can pin messages; channels only
     * @param bool|null $canPinMessages Optional. True, if the user is allowed to pin messages; groups and supergroups only
     */
    public function __construct(
        public bool $isAnonymous,
        public bool $canManageChat,
        public bool $canDeleteMessages,
        public bool $canManageVideoChats,
        public bool $canRestrictMembers,
        public bool $canPromoteMembers,
        public bool $canChangeInfo,
        public bool $canInviteUsers,
        public ?bool $canPostMessages = null,
        public ?bool $canEditMessages = null,
        public ?bool $canPinMessages = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['is_anonymous'],
            $payload['can_manage_chat'],
            $payload['can_delete_messages'],
            $payload['can_manage_video_chats'],
            $payload['can_restrict_members'],
            $payload['can_promote_members'],
            $payload['can_change_info'],
            $payload['can_invite_users'],
            $payload['can_post_messages'] ?? null,
            $payload['can_edit_messages'] ?? null,
            $payload['can_pin_messages'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'is_anonymous' => $this->isAnonymous,
            'can_manage_chat' => $this->canManageChat,
            'can_delete_messages' => $this->canDeleteMessages,
            'can_manage_video_chats' => $this->canManageVideoChats,
            'can_restrict_members' => $this->canRestrictMembers,
            'can_promote_members' => $this->canPromoteMembers,
            'can_change_info' => $this->canChangeInfo,
            'can_invite_users' => $this->canInviteUsers,
            'can_post_messages' => $this->canPostMessages,
            'can_edit_messages' => $this->canEditMessages,
            'can_pin_messages' => $this->canPinMessages,
        ]);
    }
}