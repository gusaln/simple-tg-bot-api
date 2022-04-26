<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use InvalidArgumentException;
use JsonSerializable;

/**
 * This object contains information about one member of a chat. Currently, the following 6 types of chat members are supported:
 *
 * ChatMemberOwner
 * ChatMemberAdministrator
 * ChatMemberMember
 * ChatMemberRestricted
 * ChatMemberLeft
 * ChatMemberBanned
 *
 */
abstract class ChatMember implements JsonSerializable
{
    public const CHAT_MEMBER_OWNER_STATUS = 'creator';
    public const CHAT_MEMBER_ADMINISTRATOR_STATUS = 'administrator';
    public const CHAT_MEMBER_MEMBER_STATUS = 'member';
    public const CHAT_MEMBER_RESTRICTED_STATUS = 'restricted';
    public const CHAT_MEMBER_LEFT_STATUS = 'left';
    public const CHAT_MEMBER_BANNED_STATUS = 'kicked';

    abstract public function status(): string;

    /** @phpstan-param array{status: string} $payload */
    public static function fromPayload(array $payload): self
    {
        return match($payload['status']) {
            'creator' => ChatMemberOwner::fromPayload($payload),
            'administrator' => ChatMemberAdministrator::fromPayload($payload),
            'member' => ChatMemberMember::fromPayload($payload),
            'restricted' => ChatMemberRestricted::fromPayload($payload),
            'left' => ChatMemberLeft::fromPayload($payload),
            'kicked' => ChatMemberBanned::fromPayload($payload),
            default => throw new InvalidArgumentException(sprintf('Type %s is not a child of %s', $payload['status'], ChatMember::class)),
        };
    }
}