<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * Represents an invite link for a chat.
 */
class ChatInviteLink implements JsonSerializable
{
    /**
     * @param string $inviteLink The invite link. If the link was created by another chat administrator, then the second part of the link will be replaced with "…".
     * @param User $creator Creator of the link
     * @param bool $createsJoinRequest True, if users joining the chat via the link need to be approved by chat administrators
     * @param bool $isPrimary True, if the link is primary
     * @param bool $isRevoked True, if the link is revoked
     * @param string|null $name Optional. Invite link name
     * @param int|null $expireDate Optional. Point in time (Unix timestamp) when the link will expire or has been expired
     * @param int|null $memberLimit Optional. Maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link; 1-99999
     * @param int|null $pendingJoinRequestCount Optional. Number of pending join requests created using this link
     */
    public function __construct(
        public string $inviteLink,
        public User $creator,
        public bool $createsJoinRequest,
        public bool $isPrimary,
        public bool $isRevoked,
        public ?string $name = null,
        public ?int $expireDate = null,
        public ?int $memberLimit = null,
        public ?int $pendingJoinRequestCount = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['invite_link'],
            User::fromPayload($payload['creator']),
            $payload['creates_join_request'],
            $payload['is_primary'],
            $payload['is_revoked'],
            $payload['name'] ?? null,
            $payload['expire_date'] ?? null,
            $payload['member_limit'] ?? null,
            $payload['pending_join_request_count'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'invite_link' => $this->inviteLink,
            'creator' => $this->creator,
            'creates_join_request' => $this->createsJoinRequest,
            'is_primary' => $this->isPrimary,
            'is_revoked' => $this->isRevoked,
            'name' => $this->name,
            'expire_date' => $this->expireDate,
            'member_limit' => $this->memberLimit,
            'pending_join_request_count' => $this->pendingJoinRequestCount,
        ]);
    }
}