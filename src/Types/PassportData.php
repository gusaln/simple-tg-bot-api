<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\EncryptedCredentials;
use GusALN\TelegramBotApi\Types\EncryptedPassportElement;
use JsonSerializable;

/**
 * Contains information about Telegram Passport data shared with the bot by the user.
 */
class PassportData implements JsonSerializable
{
    /**
     * @param EncryptedPassportElement[] $data Array with information about documents and other Telegram Passport elements that was shared with the bot
     * @param EncryptedCredentials $credentials Encrypted credentials required to decrypt the data
     */
    public function __construct(
        public array $data,
        public EncryptedCredentials $credentials,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            array_map(fn($t) => EncryptedPassportElement::fromPayload($t), $payload['data']),
            EncryptedCredentials::fromPayload($payload['credentials']),
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'data' => $this->data,
            'credentials' => $this->credentials,
        ]);
    }
}