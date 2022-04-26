<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a point on the map.
 */
class Location implements JsonSerializable
{
    /**
     * @param float $longitude Longitude as defined by sender
     * @param float $latitude Latitude as defined by sender
     * @param float|null $horizontalAccuracy Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $livePeriod Optional. Time relative to the message sending date, during which the location can be updated; in seconds. For active live locations only.
     * @param int|null $heading Optional. The direction in which user is moving, in degrees; 1-360. For active live locations only.
     * @param int|null $proximityAlertRadius Optional. Maximum distance for proximity alerts about approaching another chat member, in meters. For sent live locations only.
     */
    public function __construct(
        public float $longitude,
        public float $latitude,
        public ?float $horizontalAccuracy = null,
        public ?int $livePeriod = null,
        public ?int $heading = null,
        public ?int $proximityAlertRadius = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['longitude'],
            $payload['latitude'],
            $payload['horizontal_accuracy'] ?? null,
            $payload['live_period'] ?? null,
            $payload['heading'] ?? null,
            $payload['proximity_alert_radius'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'horizontal_accuracy' => $this->horizontalAccuracy,
            'live_period' => $this->livePeriod,
            'heading' => $this->heading,
            'proximity_alert_radius' => $this->proximityAlertRadius,
        ]);
    }
}