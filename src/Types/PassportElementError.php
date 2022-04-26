<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use InvalidArgumentException;
use JsonSerializable;

/**
 * This object represents an error in the Telegram Passport element which was submitted that should be resolved by the user. It should be one of:
 *
 * PassportElementErrorDataField
 * PassportElementErrorFrontSide
 * PassportElementErrorReverseSide
 * PassportElementErrorSelfie
 * PassportElementErrorFile
 * PassportElementErrorFiles
 * PassportElementErrorTranslationFile
 * PassportElementErrorTranslationFiles
 * PassportElementErrorUnspecified
 *
 */
abstract class PassportElementError implements JsonSerializable
{
    public const PASSPORT_ELEMENT_ERROR_DATA_FIELD_SOURCE = 'data';
    public const PASSPORT_ELEMENT_ERROR_FRONT_SIDE_SOURCE = 'front_side';
    public const PASSPORT_ELEMENT_ERROR_REVERSE_SIDE_SOURCE = 'reverse_side';
    public const PASSPORT_ELEMENT_ERROR_SELFIE_SOURCE = 'selfie';
    public const PASSPORT_ELEMENT_ERROR_FILE_SOURCE = 'file';
    public const PASSPORT_ELEMENT_ERROR_FILES_SOURCE = 'files';
    public const PASSPORT_ELEMENT_ERROR_TRANSLATION_FILE_SOURCE = 'translation_file';
    public const PASSPORT_ELEMENT_ERROR_TRANSLATION_FILES_SOURCE = 'translation_files';
    public const PASSPORT_ELEMENT_ERROR_UNSPECIFIED_SOURCE = 'unspecified';

    abstract public function source(): string;

    /** @phpstan-param array{source: string} $payload */
    public static function fromPayload(array $payload): self
    {
        return match($payload['source']) {
            'data' => PassportElementErrorDataField::fromPayload($payload),
            'front_side' => PassportElementErrorFrontSide::fromPayload($payload),
            'reverse_side' => PassportElementErrorReverseSide::fromPayload($payload),
            'selfie' => PassportElementErrorSelfie::fromPayload($payload),
            'file' => PassportElementErrorFile::fromPayload($payload),
            'files' => PassportElementErrorFiles::fromPayload($payload),
            'translation_file' => PassportElementErrorTranslationFile::fromPayload($payload),
            'translation_files' => PassportElementErrorTranslationFiles::fromPayload($payload),
            'unspecified' => PassportElementErrorUnspecified::fromPayload($payload),
            default => throw new InvalidArgumentException(sprintf('Type %s is not a child of %s', $payload['source'], PassportElementError::class)),
        };
    }
}