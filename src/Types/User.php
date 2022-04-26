<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a Telegram user or bot.
 */
class User implements JsonSerializable
{
    /**
     * @param int $id Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @param bool $isBot True, if this user is a bot
     * @param string $firstName User's or bot's first name
     * @param string|null $lastName Optional. User's or bot's last name
     * @param string|null $username Optional. User's or bot's username
     * @param string|null $languageCode Optional. IETF language tag of the user's language
     * @param bool|null $canJoinGroups Optional. True, if the bot can be invited to groups. Returned only in getMe.
     * @param bool|null $canReadAllGroupMessages Optional. True, if privacy mode is disabled for the bot. Returned only in getMe.
     * @param bool|null $supportsInlineQueries Optional. True, if the bot supports inline queries. Returned only in getMe.
     */
    public function __construct(
        public int $id,
        public bool $isBot,
        public string $firstName,
        public ?string $lastName = null,
        public ?string $username = null,
        public ?string $languageCode = null,
        public ?bool $canJoinGroups = null,
        public ?bool $canReadAllGroupMessages = null,
        public ?bool $supportsInlineQueries = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['id'],
            $payload['is_bot'],
            $payload['first_name'],
            $payload['last_name'] ?? null,
            $payload['username'] ?? null,
            $payload['language_code'] ?? null,
            $payload['can_join_groups'] ?? null,
            $payload['can_read_all_group_messages'] ?? null,
            $payload['supports_inline_queries'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'id' => $this->id,
            'is_bot' => $this->isBot,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'username' => $this->username,
            'language_code' => $this->languageCode,
            'can_join_groups' => $this->canJoinGroups,
            'can_read_all_group_messages' => $this->canReadAllGroupMessages,
            'supports_inline_queries' => $this->supportsInlineQueries,
        ]);
    }
}