<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use InvalidArgumentException;
use JsonSerializable;

/**
 * This object represents the content of a message to be sent as a result of an inline query. Telegram clients currently support the following 5 types:
 *
 * InputTextMessageContent
 * InputLocationMessageContent
 * InputVenueMessageContent
 * InputContactMessageContent
 * InputInvoiceMessageContent
 *
 */
abstract class InputMessageContent implements JsonSerializable
{
    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        if (isset($payload['message_text'])) {
            return InputTextMessageContent::fromPayload($payload);
        }

        if (isset($payload['proximity_alert_radius'])) {
            return InputLocationMessageContent::fromPayload($payload);
        }

        if (isset($payload['address'])) {
            return InputVenueMessageContent::fromPayload($payload);
        }

        if (isset($payload['phone_number'])) {
            return InputContactMessageContent::fromPayload($payload);
        }

        if (isset($payload['prices'])) {
            return InputInvoiceMessageContent::fromPayload($payload);
        }

        throw new InvalidArgumentException(sprintf('The payload is not a child of %s', InputMessageContent::class));
    }
}