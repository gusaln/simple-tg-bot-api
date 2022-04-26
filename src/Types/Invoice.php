<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object contains basic information about an invoice.
 */
class Invoice implements JsonSerializable
{
    /**
     * @param string $title Product name
     * @param string $description Product description
     * @param string $startParameter Unique bot deep-linking parameter that can be used to generate this invoice
     * @param string $currency Three-letter ISO 4217 currency code
     * @param int $totalAmount Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     */
    public function __construct(
        public string $title,
        public string $description,
        public string $startParameter,
        public string $currency,
        public int $totalAmount,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['title'],
            $payload['description'],
            $payload['start_parameter'],
            $payload['currency'],
            $payload['total_amount'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'title' => $this->title,
            'description' => $this->description,
            'start_parameter' => $this->startParameter,
            'currency' => $this->currency,
            'total_amount' => $this->totalAmount,
        ]);
    }
}