<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\LabeledPrice;
use JsonSerializable;

/**
 * This object represents one shipping option.
 */
class ShippingOption implements JsonSerializable
{
    /**
     * @param string $id Shipping option identifier
     * @param string $title Option title
     * @param LabeledPrice[] $prices List of price portions
     */
    public function __construct(
        public string $id,
        public string $title,
        public array $prices,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['id'],
            $payload['title'],
            array_map(fn($t) => LabeledPrice::fromPayload($t), $payload['prices']),
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'id' => $this->id,
            'title' => $this->title,
            'prices' => $this->prices,
        ]);
    }
}