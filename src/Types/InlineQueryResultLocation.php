<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\InputMessageContent;
use JsonSerializable;

/**
 * Represents a location on a map. By default, the location will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the location.
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will ignore them.
 */
class InlineQueryResultLocation extends InlineQueryResult implements JsonSerializable
{
    private string $type = 'location';

    /**
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param float $latitude Location latitude in degrees
     * @param float $longitude Location longitude in degrees
     * @param string $title Location title
     * @param float|null $horizontalAccuracy Optional. The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $livePeriod Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
     * @param int|null $heading Optional. For live locations, a direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
     * @param int|null $proximityAlertRadius Optional. For live locations, a maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     * @param InlineKeyboardMarkup|null $replyMarkup Optional. Inline keyboard attached to the message
     * @param InputMessageContent|null $inputMessageContent Optional. Content of the message to be sent instead of the location
     * @param string|null $thumbUrl Optional. Url of the thumbnail for the result
     * @param int|null $thumbWidth Optional. Thumbnail width
     * @param int|null $thumbHeight Optional. Thumbnail height
     */
    public function __construct(
        public string $id,
        public float $latitude,
        public float $longitude,
        public string $title,
        public ?float $horizontalAccuracy = null,
        public ?int $livePeriod = null,
        public ?int $heading = null,
        public ?int $proximityAlertRadius = null,
        public ?InlineKeyboardMarkup $replyMarkup = null,
        public ?InputMessageContent $inputMessageContent = null,
        public ?string $thumbUrl = null,
        public ?int $thumbWidth = null,
        public ?int $thumbHeight = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['id'],
            $payload['latitude'],
            $payload['longitude'],
            $payload['title'],
            $payload['horizontal_accuracy'] ?? null,
            $payload['live_period'] ?? null,
            $payload['heading'] ?? null,
            $payload['proximity_alert_radius'] ?? null,
            isset($payload['reply_markup']) ? InlineKeyboardMarkup::fromPayload($payload['reply_markup']) : null,
            isset($payload['input_message_content']) ? InputMessageContent::fromPayload($payload['input_message_content']) : null,
            $payload['thumb_url'] ?? null,
            $payload['thumb_width'] ?? null,
            $payload['thumb_height'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'title' => $this->title,
            'horizontal_accuracy' => $this->horizontalAccuracy,
            'live_period' => $this->livePeriod,
            'heading' => $this->heading,
            'proximity_alert_radius' => $this->proximityAlertRadius,
            'reply_markup' => $this->replyMarkup,
            'input_message_content' => $this->inputMessageContent,
            'thumb_url' => $this->thumbUrl,
            'thumb_width' => $this->thumbWidth,
            'thumb_height' => $this->thumbHeight,
        ]);
    }

    /**
     * Type of the result, must be location.
     */
    public function type(): string
    {
        return $this->type;
    }
}