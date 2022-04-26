<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\PassportElementError;

/**
 * Informs a user that some of the Telegram Passport elements they provided contains errors. The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change). Returns True on success.
 * Use this if the data submitted by the user doesn't satisfy the standards your service requires for any reason. For example, if a birthday date seems invalid, a submitted document is blurry, a scan shows evidence of tampering, etc. Supply some details in the error message to make sure the user knows how to correct the issues.
 */
class SetPassportDataErrorsRequest extends MethodRequest
{
    /**
     * @param int $userId User identifier
     * @param PassportElementError[] $errors A JSON-serialized array describing the errors
    */
    public function __construct(
        public int $userId,
        public array $errors,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['user_id'],
            array_map(fn($t) => PassportElementError::fromPayload($t), $payload['errors']),
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'user_id' => $this->userId,
            'errors' => $this->errors,
        ]);
    }

    public function method(): string
    {
        return 'setPassportDataErrors';
    }
}