<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\ShippingAddress;
use JsonSerializable;

/**
 * This object represents information about an order.
 */
class OrderInfo implements JsonSerializable
{
    /**
     * @param string|null $name Optional. User name
     * @param string|null $phoneNumber Optional. User's phone number
     * @param string|null $email Optional. User email
     * @param ShippingAddress|null $shippingAddress Optional. User shipping address
     */
    public function __construct(
        public ?string $name = null,
        public ?string $phoneNumber = null,
        public ?string $email = null,
        public ?ShippingAddress $shippingAddress = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['name'] ?? null,
            $payload['phone_number'] ?? null,
            $payload['email'] ?? null,
            isset($payload['shipping_address']) ? ShippingAddress::fromPayload($payload['shipping_address']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'name' => $this->name,
            'phone_number' => $this->phoneNumber,
            'email' => $this->email,
            'shipping_address' => $this->shippingAddress,
        ]);
    }
}