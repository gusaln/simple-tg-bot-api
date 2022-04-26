<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Contains data required for decrypting and authenticating EncryptedPassportElement. See the Telegram Passport Documentation for a complete description of the data decryption and authentication processes.
 */
class EncryptedCredentials implements JsonSerializable
{
    /**
     * @param string $data Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for EncryptedPassportElement decryption and authentication
     * @param string $hash Base64-encoded data hash for data authentication
     * @param string $secret Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption
     */
    public function __construct(
        public string $data,
        public string $hash,
        public string $secret,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['data'],
            $payload['hash'],
            $payload['secret'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'data' => $this->data,
            'hash' => $this->hash,
            'secret' => $this->secret,
        ]);
    }
}