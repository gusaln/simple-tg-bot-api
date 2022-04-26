<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents the content of a contact message to be sent as the result of an inline query.
 */
class InputContactMessageContent extends InputMessageContent implements JsonSerializable
{
    /**
     * @param string $phoneNumber Contact's phone number
     * @param string $firstName Contact's first name
     * @param string|null $lastName Optional. Contact's last name
     * @param string|null $vcard Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes
     */
    public function __construct(
        public string $phoneNumber,
        public string $firstName,
        public ?string $lastName = null,
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
            $payload['vcard'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'phone_number' => $this->phoneNumber,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'vcard' => $this->vcard,
        ]);
    }
}