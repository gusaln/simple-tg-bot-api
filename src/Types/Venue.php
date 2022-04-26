<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\Location;
use JsonSerializable;

/**
 * This object represents a venue.
 */
class Venue implements JsonSerializable
{
    /**
     * @param Location $location Venue location. Can't be a live location
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @param string|null $foursquareId Optional. Foursquare identifier of the venue
     * @param string|null $foursquareType Optional. Foursquare type of the venue. (For example, "arts_entertainment/default", "arts_entertainment/aquarium" or "food/icecream".)
     * @param string|null $googlePlaceId Optional. Google Places identifier of the venue
     * @param string|null $googlePlaceType Optional. Google Places type of the venue. (See supported types.)
     */
    public function __construct(
        public Location $location,
        public string $title,
        public string $address,
        public ?string $foursquareId = null,
        public ?string $foursquareType = null,
        public ?string $googlePlaceId = null,
        public ?string $googlePlaceType = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            Location::fromPayload($payload['location']),
            $payload['title'],
            $payload['address'],
            $payload['foursquare_id'] ?? null,
            $payload['foursquare_type'] ?? null,
            $payload['google_place_id'] ?? null,
            $payload['google_place_type'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'location' => $this->location,
            'title' => $this->title,
            'address' => $this->address,
            'foursquare_id' => $this->foursquareId,
            'foursquare_type' => $this->foursquareType,
            'google_place_id' => $this->googlePlaceId,
            'google_place_type' => $this->googlePlaceType,
        ]);
    }
}