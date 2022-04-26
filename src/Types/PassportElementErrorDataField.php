<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents an issue in one of the data fields that was provided by the user. The error is considered resolved when the field's value changes.
 */
class PassportElementErrorDataField extends PassportElementError implements JsonSerializable
{
    private string $source = 'data';

    /**
     * @param string $type The section of the user's Telegram Passport which has the error, one of "personal_details", "passport", "driver_license", "identity_card", "internal_passport", "address"
     * @param string $fieldName Name of the data field which has the error
     * @param string $dataHash Base64-encoded data hash
     * @param string $message Error message
     */
    public function __construct(
        public string $type,
        public string $fieldName,
        public string $dataHash,
        public string $message,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['type'],
            $payload['field_name'],
            $payload['data_hash'],
            $payload['message'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'source' => $this->source,
            'type' => $this->type,
            'field_name' => $this->fieldName,
            'data_hash' => $this->dataHash,
            'message' => $this->message,
        ]);
    }

    /**
     * Error source, must be data.
     */
    public function source(): string
    {
        return $this->source;
    }
}