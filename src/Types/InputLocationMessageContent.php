<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
 */
class InputLocationMessageContent extends InputMessageContent implements JsonSerializable
{
    /**
     * @param float $latitude Latitude of the location in degrees
     * @param float $longitude Longitude of the location in degrees
     * @param float|null $horizontalAccuracy Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $livePeriod Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
     * @param int|null $heading Optional. For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
     * @param int|null $proximityAlertRadius Optional. For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     */
    public function __construct(
        public float $latitude,
        public float $longitude,
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
            $payload['latitude'],
            $payload['longitude'],
            $payload['horizontal_accuracy'] ?? null,
            $payload['live_period'] ?? null,
            $payload['heading'] ?? null,
            $payload['proximity_alert_radius'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'horizontal_accuracy' => $this->horizontalAccuracy,
            'live_period' => $this->livePeriod,
            'heading' => $this->heading,
            'proximity_alert_radius' => $this->proximityAlertRadius,
        ]);
    }
}