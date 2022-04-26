<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a portion of the price for goods or services.
 */
class LabeledPrice implements JsonSerializable
{
    /**
     * @param string $label Portion label
     * @param int $amount Price of the product in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public function __construct(
        public string $label,
        public int $amount,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['label'],
            $payload['amount'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'label' => $this->label,
            'amount' => $this->amount,
        ]);
    }
}