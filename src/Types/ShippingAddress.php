<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a shipping address.
 */
class ShippingAddress implements JsonSerializable
{
    /**
     * @param string $countryCode ISO 3166-1 alpha-2 country code
     * @param string $state State, if applicable
     * @param string $city City
     * @param string $streetLine1 First line for the address
     * @param string $streetLine2 Second line for the address
     * @param string $postCode Address post code
     */
    public function __construct(
        public string $countryCode,
        public string $state,
        public string $city,
        public string $streetLine1,
        public string $streetLine2,
        public string $postCode,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['country_code'],
            $payload['state'],
            $payload['city'],
            $payload['street_line1'],
            $payload['street_line2'],
            $payload['post_code'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'country_code' => $this->countryCode,
            'state' => $this->state,
            'city' => $this->city,
            'street_line1' => $this->streetLine1,
            'street_line2' => $this->streetLine2,
            'post_code' => $this->postCode,
        ]);
    }
}