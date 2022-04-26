<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use InvalidArgumentException;
use JsonSerializable;

/**
 * This object represents the scope to which bot commands are applied. Currently, the following 7 scopes are supported:
 *
 * BotCommandScopeDefault
 * BotCommandScopeAllPrivateChats
 * BotCommandScopeAllGroupChats
 * BotCommandScopeAllChatAdministrators
 * BotCommandScopeChat
 * BotCommandScopeChatAdministrators
 * BotCommandScopeChatMember
 *
 */
abstract class BotCommandScope implements JsonSerializable
{
    public const BOT_COMMAND_SCOPE_DEFAULT_TYPE = 'default';
    public const BOT_COMMAND_SCOPE_ALL_PRIVATE_CHATS_TYPE = 'all_private_chats';
    public const BOT_COMMAND_SCOPE_ALL_GROUP_CHATS_TYPE = 'all_group_chats';
    public const BOT_COMMAND_SCOPE_ALL_CHAT_ADMINISTRATORS_TYPE = 'all_chat_administrators';
    public const BOT_COMMAND_SCOPE_CHAT_TYPE = 'chat';
    public const BOT_COMMAND_SCOPE_CHAT_ADMINISTRATORS_TYPE = 'chat_administrators';
    public const BOT_COMMAND_SCOPE_CHAT_MEMBER_TYPE = 'chat_member';

    abstract public function type(): string;

    /** @phpstan-param array{type: string} $payload */
    public static function fromPayload(array $payload): self
    {
        return match($payload['type']) {
            'default' => BotCommandScopeDefault::fromPayload($payload),
            'all_private_chats' => BotCommandScopeAllPrivateChats::fromPayload($payload),
            'all_group_chats' => BotCommandScopeAllGroupChats::fromPayload($payload),
            'all_chat_administrators' => BotCommandScopeAllChatAdministrators::fromPayload($payload),
            'chat' => BotCommandScopeChat::fromPayload($payload),
            'chat_administrators' => BotCommandScopeChatAdministrators::fromPayload($payload),
            'chat_member' => BotCommandScopeChatMember::fromPayload($payload),
            default => throw new InvalidArgumentException(sprintf('Type %s is not a child of %s', $payload['type'], BotCommandScope::class)),
        };
    }
}