<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Describes actions that a non-administrator user is allowed to take in a chat.
 */
class ChatPermissions implements JsonSerializable
{
    /**
     * @param bool|null $canSendMessages Optional. True, if the user is allowed to send text messages, contacts, locations and venues
     * @param bool|null $canSendMediaMessages Optional. True, if the user is allowed to send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages
     * @param bool|null $canSendPolls Optional. True, if the user is allowed to send polls, implies can_send_messages
     * @param bool|null $canSendOtherMessages Optional. True, if the user is allowed to send animations, games, stickers and use inline bots, implies can_send_media_messages
     * @param bool|null $canAddWebPagePreviews Optional. True, if the user is allowed to add web page previews to their messages, implies can_send_media_messages
     * @param bool|null $canChangeInfo Optional. True, if the user is allowed to change the chat title, photo and other settings. Ignored in public supergroups
     * @param bool|null $canInviteUsers Optional. True, if the user is allowed to invite new users to the chat
     * @param bool|null $canPinMessages Optional. True, if the user is allowed to pin messages. Ignored in public supergroups
     */
    public function __construct(
        public ?bool $canSendMessages = null,
        public ?bool $canSendMediaMessages = null,
        public ?bool $canSendPolls = null,
        public ?bool $canSendOtherMessages = null,
        public ?bool $canAddWebPagePreviews = null,
        public ?bool $canChangeInfo = null,
        public ?bool $canInviteUsers = null,
        public ?bool $canPinMessages = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['can_send_messages'] ?? null,
            $payload['can_send_media_messages'] ?? null,
            $payload['can_send_polls'] ?? null,
            $payload['can_send_other_messages'] ?? null,
            $payload['can_add_web_page_previews'] ?? null,
            $payload['can_change_info'] ?? null,
            $payload['can_invite_users'] ?? null,
            $payload['can_pin_messages'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'can_send_messages' => $this->canSendMessages,
            'can_send_media_messages' => $this->canSendMediaMessages,
            'can_send_polls' => $this->canSendPolls,
            'can_send_other_messages' => $this->canSendOtherMessages,
            'can_add_web_page_previews' => $this->canAddWebPagePreviews,
            'can_change_info' => $this->canChangeInfo,
            'can_invite_users' => $this->canInviteUsers,
            'can_pin_messages' => $this->canPinMessages,
        ]);
    }
}