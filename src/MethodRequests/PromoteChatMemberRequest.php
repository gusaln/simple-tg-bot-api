<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Pass False for all boolean parameters to demote a user. Returns True on success.
 */
class PromoteChatMemberRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $userId Unique identifier of the target user
     * @param bool|null $isAnonymous Pass True, if the administrator's presence in the chat is hidden
     * @param bool|null $canManageChat Pass True, if the administrator can access the chat event log, chat statistics, message statistics in channels, see channel members, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
     * @param bool|null $canPostMessages Pass True, if the administrator can create channel posts, channels only
     * @param bool|null $canEditMessages Pass True, if the administrator can edit messages of other users and can pin messages, channels only
     * @param bool|null $canDeleteMessages Pass True, if the administrator can delete messages of other users
     * @param bool|null $canManageVideoChats Pass True, if the administrator can manage video chats
     * @param bool|null $canRestrictMembers Pass True, if the administrator can restrict, ban or unban chat members
     * @param bool|null $canPromoteMembers Pass True, if the administrator can add new administrators with a subset of their own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by him)
     * @param bool|null $canChangeInfo Pass True, if the administrator can change chat title, photo and other settings
     * @param bool|null $canInviteUsers Pass True, if the administrator can invite new users to the chat
     * @param bool|null $canPinMessages Pass True, if the administrator can pin messages, supergroups only
    */
    public function __construct(
        public int|string $chatId,
        public int $userId,
        public ?bool $isAnonymous = null,
        public ?bool $canManageChat = null,
        public ?bool $canPostMessages = null,
        public ?bool $canEditMessages = null,
        public ?bool $canDeleteMessages = null,
        public ?bool $canManageVideoChats = null,
        public ?bool $canRestrictMembers = null,
        public ?bool $canPromoteMembers = null,
        public ?bool $canChangeInfo = null,
        public ?bool $canInviteUsers = null,
        public ?bool $canPinMessages = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'],
            $payload['user_id'],
            $payload['is_anonymous'] ?? null,
            $payload['can_manage_chat'] ?? null,
            $payload['can_post_messages'] ?? null,
            $payload['can_edit_messages'] ?? null,
            $payload['can_delete_messages'] ?? null,
            $payload['can_manage_video_chats'] ?? null,
            $payload['can_restrict_members'] ?? null,
            $payload['can_promote_members'] ?? null,
            $payload['can_change_info'] ?? null,
            $payload['can_invite_users'] ?? null,
            $payload['can_pin_messages'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'user_id' => $this->userId,
            'is_anonymous' => $this->isAnonymous,
            'can_manage_chat' => $this->canManageChat,
            'can_post_messages' => $this->canPostMessages,
            'can_edit_messages' => $this->canEditMessages,
            'can_delete_messages' => $this->canDeleteMessages,
            'can_manage_video_chats' => $this->canManageVideoChats,
            'can_restrict_members' => $this->canRestrictMembers,
            'can_promote_members' => $this->canPromoteMembers,
            'can_change_info' => $this->canChangeInfo,
            'can_invite_users' => $this->canInviteUsers,
            'can_pin_messages' => $this->canPinMessages,
        ]);
    }

    public function method(): string
    {
        return 'promoteChatMember';
    }
}