<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a phone contact.
 */
class Contact implements JsonSerializable
{
    /**
     * @param string $phoneNumber Contact's phone number
     * @param string $firstName Contact's first name
     * @param string|null $lastName Optional. Contact's last name
     * @param int|null $userId Optional. Contact's user identifier in Telegram. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
     * @param string|null $vcard Optional. Additional data about the contact in the form of a vCard
     */
    public function __construct(
        public string $phoneNumber,
        public string $firstName,
        public ?string $lastName = null,
        public ?int $userId = null,
        public ?string $vcard = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['phone_number'],
            $payload['first_name'],
            $payload['last_name'] ?? null,
            $payload['user_id'] ?? null,
            $payload['vcard'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'phone_number' => $this->phoneNumber,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'user_id' => $this->userId,
            'vcard' => $this->vcard,
        ]);
    }
}