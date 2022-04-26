<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\PassportFile;
use JsonSerializable;

/**
 * Contains information about documents or other Telegram Passport elements shared with the bot by the user.
 */
class EncryptedPassportElement implements JsonSerializable
{
    /**
     * @param string $type Element type. One of "personal_details", "passport", "driver_license", "identity_card", "internal_passport", "address", "utility_bill", "bank_statement", "rental_agreement", "passport_registration", "temporary_registration", "phone_number", "email".
     * @param string|null $data Optional. Base64-encoded encrypted Telegram Passport element data provided by the user, available for "personal_details", "passport", "driver_license", "identity_card", "internal_passport" and "address" types. Can be decrypted and verified using the accompanying EncryptedCredentials.
     * @param string|null $phoneNumber Optional. User's verified phone number, available only for "phone_number" type
     * @param string|null $email Optional. User's verified email address, available only for "email" type
     * @param PassportFile[]|null $files Optional. Array of encrypted files with documents provided by the user, available for "utility_bill", "bank_statement", "rental_agreement", "passport_registration" and "temporary_registration" types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     * @param PassportFile|null $frontSide Optional. Encrypted file with the front side of the document, provided by the user. Available for "passport", "driver_license", "identity_card" and "internal_passport". The file can be decrypted and verified using the accompanying EncryptedCredentials.
     * @param PassportFile|null $reverseSide Optional. Encrypted file with the reverse side of the document, provided by the user. Available for "driver_license" and "identity_card". The file can be decrypted and verified using the accompanying EncryptedCredentials.
     * @param PassportFile|null $selfie Optional. Encrypted file with the selfie of the user holding a document, provided by the user; available for "passport", "driver_license", "identity_card" and "internal_passport". The file can be decrypted and verified using the accompanying EncryptedCredentials.
     * @param PassportFile[]|null $translation Optional. Array of encrypted files with translated versions of documents provided by the user. Available if requested for "passport", "driver_license", "identity_card", "internal_passport", "utility_bill", "bank_statement", "rental_agreement", "passport_registration" and "temporary_registration" types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     * @param string $hash Base64-encoded element hash for using in PassportElementErrorUnspecified
     */
    public function __construct(
        public string $type,
        public ?string $data = null,
        public ?string $phoneNumber = null,
        public ?string $email = null,
        public ?array $files = null,
        public ?PassportFile $frontSide = null,
        public ?PassportFile $reverseSide = null,
        public ?PassportFile $selfie = null,
        public ?array $translation = null,
        public string $hash,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['type'],
            $payload['data'] ?? null,
            $payload['phone_number'] ?? null,
            $payload['email'] ?? null,
            isset($payload['files']) ? array_map(fn($t) => PassportFile::fromPayload($t), $payload['files']) : null,
            isset($payload['front_side']) ? PassportFile::fromPayload($payload['front_side']) : null,
            isset($payload['reverse_side']) ? PassportFile::fromPayload($payload['reverse_side']) : null,
            isset($payload['selfie']) ? PassportFile::fromPayload($payload['selfie']) : null,
            isset($payload['translation']) ? array_map(fn($t) => PassportFile::fromPayload($t), $payload['translation']) : null,
            $payload['hash'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'data' => $this->data,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email,
            'files' => $this->files,
            'front_side' => $this->frontSide,
            'reverse_side' => $this->reverseSide,
            'selfie' => $this->selfie,
            'translation' => $this->translation,
            'hash' => $this->hash,
        ]);
    }
}