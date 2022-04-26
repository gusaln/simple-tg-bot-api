<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\ChatLocation;
use GusALN\TelegramBotApi\Types\ChatPermissions;
use GusALN\TelegramBotApi\Types\ChatPhoto;
use GusALN\TelegramBotApi\Types\Message;
use JsonSerializable;

/**
 * This object represents a chat.
 */
class Chat implements JsonSerializable
{
    /**
     * @param int $id Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @param string $type Type of chat, can be either "private", "group", "supergroup" or "channel"
     * @param string|null $title Optional. Title, for supergroups, channels and group chats
     * @param string|null $username Optional. Username, for private chats, supergroups and channels if available
     * @param string|null $firstName Optional. First name of the other party in a private chat
     * @param string|null $lastName Optional. Last name of the other party in a private chat
     * @param ChatPhoto|null $photo Optional. Chat photo. Returned only in getChat.
     * @param string|null $bio Optional. Bio of the other party in a private chat. Returned only in getChat.
     * @param bool|null $hasPrivateForwards Optional. True, if privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user. Returned only in getChat.
     * @param string|null $description Optional. Description, for groups, supergroups and channel chats. Returned only in getChat.
     * @param string|null $inviteLink Optional. Primary invite link, for groups, supergroups and channel chats. Returned only in getChat.
     * @param Message|null $pinnedMessage Optional. The most recent pinned message (by sending date). Returned only in getChat.
     * @param ChatPermissions|null $permissions Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat.
     * @param int|null $slowModeDelay Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user; in seconds. Returned only in getChat.
     * @param int|null $messageAutoDeleteTime Optional. The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in getChat.
     * @param bool|null $hasProtectedContent Optional. True, if messages from the chat can't be forwarded to other chats. Returned only in getChat.
     * @param string|null $stickerSetName Optional. For supergroups, name of group sticker set. Returned only in getChat.
     * @param bool|null $canSetStickerSet Optional. True, if the bot can change the group sticker set. Returned only in getChat.
     * @param int|null $linkedChatId Optional. Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this identifier. Returned only in getChat.
     * @param ChatLocation|null $location Optional. For supergroups, the location to which the supergroup is connected. Returned only in getChat.
     */
    public function __construct(
        public int $id,
        public string $type,
        public ?string $title = null,
        public ?string $username = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?ChatPhoto $photo = null,
        public ?string $bio = null,
        public ?bool $hasPrivateForwards = null,
        public ?string $description = null,
        public ?string $inviteLink = null,
        public ?Message $pinnedMessage = null,
        public ?ChatPermissions $permissions = null,
        public ?int $slowModeDelay = null,
        public ?int $messageAutoDeleteTime = null,
        public ?bool $hasProtectedContent = null,
        public ?string $stickerSetName = null,
        public ?bool $canSetStickerSet = null,
        public ?int $linkedChatId = null,
        public ?ChatLocation $location = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['id'],
            $payload['type'],
            $payload['title'] ?? null,
            $payload['username'] ?? null,
            $payload['first_name'] ?? null,
            $payload['last_name'] ?? null,
            isset($payload['photo']) ? ChatPhoto::fromPayload($payload['photo']) : null,
            $payload['bio'] ?? null,
            $payload['has_private_forwards'] ?? null,
            $payload['description'] ?? null,
            $payload['invite_link'] ?? null,
            isset($payload['pinned_message']) ? Message::fromPayload($payload['pinned_message']) : null,
            isset($payload['permissions']) ? ChatPermissions::fromPayload($payload['permissions']) : null,
            $payload['slow_mode_delay'] ?? null,
            $payload['message_auto_delete_time'] ?? null,
            $payload['has_protected_content'] ?? null,
            $payload['sticker_set_name'] ?? null,
            $payload['can_set_sticker_set'] ?? null,
            $payload['linked_chat_id'] ?? null,
            isset($payload['location']) ? ChatLocation::fromPayload($payload['location']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'username' => $this->username,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'photo' => $this->photo,
            'bio' => $this->bio,
            'has_private_forwards' => $this->hasPrivateForwards,
            'description' => $this->description,
            'invite_link' => $this->inviteLink,
            'pinned_message' => $this->pinnedMessage,
            'permissions' => $this->permissions,
            'slow_mode_delay' => $this->slowModeDelay,
            'message_auto_delete_time' => $this->messageAutoDeleteTime,
            'has_protected_content' => $this->hasProtectedContent,
            'sticker_set_name' => $this->stickerSetName,
            'can_set_sticker_set' => $this->canSetStickerSet,
            'linked_chat_id' => $this->linkedChatId,
            'location' => $this->location,
        ]);
    }
}