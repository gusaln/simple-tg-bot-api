<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\ShippingAddress;
use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * This object contains information about an incoming shipping query.
 */
class ShippingQuery implements JsonSerializable
{
    /**
     * @param string $id Unique query identifier
     * @param User $from User who sent the query
     * @param string $invoicePayload Bot specified invoice payload
     * @param ShippingAddress $shippingAddress User specified shipping address
     */
    public function __construct(
        public string $id,
        public User $from,
        public string $invoicePayload,
        public ShippingAddress $shippingAddress,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['id'],
            User::fromPayload($payload['from']),
            $payload['invoice_payload'],
            ShippingAddress::fromPayload($payload['shipping_address']),
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'id' => $this->id,
            'from' => $this->from,
            'invoice_payload' => $this->invoicePayload,
            'shipping_address' => $this->shippingAddress,
        ]);
    }
}