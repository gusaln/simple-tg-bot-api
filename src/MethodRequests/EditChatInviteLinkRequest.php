<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to edit a non-primary invite link created by the bot. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the edited invite link as a ChatInviteLink object.
 */
class EditChatInviteLinkRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $inviteLink The invite link to edit
     * @param string|null $name Invite link name; 0-32 characters
     * @param int|null $expireDate Point in time (Unix timestamp) when the link will expire
     * @param int|null $memberLimit Maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
     * @param bool|null $createsJoinRequest True, if users joining the chat via the link need to be approved by chat administrators. If True, member_limit can't be specified
    */
    public function __construct(
        public int|string $chatId,
        public string $inviteLink,
        public ?string $name = null,
        public ?int $expireDate = null,
        public ?int $memberLimit = null,
        public ?bool $createsJoinRequest = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['chat_id'],
            $payload['invite_link'],
            $payload['name'] ?? null,
            $payload['expire_date'] ?? null,
            $payload['member_limit'] ?? null,
            $payload['creates_join_request'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'invite_link' => $this->inviteLink,
            'name' => $this->name,
            'expire_date' => $this->expireDate,
            'member_limit' => $this->memberLimit,
            'creates_join_request' => $this->createsJoinRequest,
        ]);
    }

    public function method(): string
    {
        return 'editChatInviteLink';
    }
}