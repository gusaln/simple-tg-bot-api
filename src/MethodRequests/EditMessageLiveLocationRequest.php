<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;

/**
 * Use this method to edit live location messages. A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
 */
class EditMessageLiveLocationRequest extends MethodRequest
{
    /**
     * @param int|string|null $chatId Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $messageId Required if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param float $latitude Latitude of new location
     * @param float $longitude Longitude of new location
     * @param float|null $horizontalAccuracy The radius of uncertainty for the location, measured in meters; 0-1500
     * @param int|null $heading Direction in which the user is moving, in degrees. Must be between 1 and 360 if specified.
     * @param int|null $proximityAlertRadius Maximum distance for proximity alerts about approaching another chat member, in meters. Must be between 1 and 100000 if specified.
     * @param InlineKeyboardMarkup|null $replyMarkup A JSON-serialized object for a new inline keyboard.
    */
    public function __construct(
        public int|string|null $chatId = null,
        public ?int $messageId = null,
        public ?string $inlineMessageId = null,
        public float $latitude,
        public float $longitude,
        public ?float $horizontalAccuracy = null,
        public ?int $heading = null,
        public ?int $proximityAlertRadius = null,
        public ?InlineKeyboardMarkup $replyMarkup = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'] ?? null,
            $payload['message_id'] ?? null,
            $payload['inline_message_id'] ?? null,
            $payload['latitude'],
            $payload['longitude'],
            $payload['horizontal_accuracy'] ?? null,
            $payload['heading'] ?? null,
            $payload['proximity_alert_radius'] ?? null,
            isset($payload['reply_markup']) ? InlineKeyboardMarkup::fromPayload($payload['reply_markup']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
            'inline_message_id' => $this->inlineMessageId,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'horizontal_accuracy' => $this->horizontalAccuracy,
            'heading' => $this->heading,
            'proximity_alert_radius' => $this->proximityAlertRadius,
            'reply_markup' => $this->replyMarkup,
        ]);
    }

    public function method(): string
    {
        return 'editMessageLiveLocation';
    }
}