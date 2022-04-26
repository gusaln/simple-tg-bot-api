<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\ShippingOption;

/**
 * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries. On success, True is returned.
 */
class AnswerShippingQueryRequest extends MethodRequest
{
    /**
     * @param string $shippingQueryId Unique identifier for the query to be answered
     * @param bool $ok Specify True if delivery to the specified address is possible and False if there are any problems (for example, if delivery to the specified address is not possible)
     * @param ShippingOption[]|null $shippingOptions Required if ok is True. A JSON-serialized array of available shipping options.
     * @param string|null $errorMessage Required if ok is False. Error message in human readable form that explains why it is impossible to complete the order (e.g. "Sorry, delivery to your desired address is unavailable'). Telegram will display this message to the user.
    */
    public function __construct(
        public string $shippingQueryId,
        public bool $ok,
        public ?array $shippingOptions = null,
        public ?string $errorMessage = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['shipping_query_id'],
            $payload['ok'],
            isset($payload['shipping_options']) ? array_map(fn($t) => ShippingOption::fromPayload($t), $payload['shipping_options']) : null,
            $payload['error_message'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'shipping_query_id' => $this->shippingQueryId,
            'ok' => $this->ok,
            'shipping_options' => $this->shippingOptions,
            'error_message' => $this->errorMessage,
        ]);
    }

    public function method(): string
    {
        return 'answerShippingQuery';
    }
}