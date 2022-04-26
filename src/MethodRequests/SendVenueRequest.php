<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\ForceReply;
use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\ReplyKeyboardMarkup;
use GusALN\TelegramBotApi\Types\ReplyKeyboardRemove;

/**
 * Use this method to send information about a venue. On success, the sent Message is returned.
 */
class SendVenueRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param float $latitude Latitude of the venue
     * @param float $longitude Longitude of the venue
     * @param string $title Name of the venue
     * @param string $address Address of the venue
     * @param string|null $foursquareId Foursquare identifier of the venue
     * @param string|null $foursquareType Foursquare type of the venue, if known. (For example, "arts_entertainment/default", "arts_entertainment/aquarium" or "food/icecream".)
     * @param string|null $googlePlaceId Google Places identifier of the venue
     * @param string|null $googlePlaceType Google Places type of the venue. (See supported types.)
     * @param bool|null $disableNotification Sends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protectContent Protects the contents of the sent message from forwarding and saving
     * @param int|null $replyToMessageId If the message is a reply, ID of the original message
     * @param bool|null $allowSendingWithoutReply Pass True, if the message should be sent even if the specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
    */
    public function __construct(
        public int|string $chatId,
        public float $latitude,
        public float $longitude,
        public string $title,
        public string $address,
        public ?string $foursquareId = null,
        public ?string $foursquareType = null,
        public ?string $googlePlaceId = null,
        public ?string $googlePlaceType = null,
        public ?bool $disableNotification = null,
        public ?bool $protectContent = null,
        public ?int $replyToMessageId = null,
        public ?bool $allowSendingWithoutReply = null,
        public InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'],
            $payload['latitude'],
            $payload['longitude'],
            $payload['title'],
            $payload['address'],
            $payload['foursquare_id'] ?? null,
            $payload['foursquare_type'] ?? null,
            $payload['google_place_id'] ?? null,
            $payload['google_place_type'] ?? null,
            $payload['disable_notification'] ?? null,
            $payload['protect_content'] ?? null,
            $payload['reply_to_message_id'] ?? null,
            $payload['allow_sending_without_reply'] ?? null,
            $payload['reply_markup'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'title' => $this->title,
            'address' => $this->address,
            'foursquare_id' => $this->foursquareId,
            'foursquare_type' => $this->foursquareType,
            'google_place_id' => $this->googlePlaceId,
            'google_place_type' => $this->googlePlaceType,
            'disable_notification' => $this->disableNotification,
            'protect_content' => $this->protectContent,
            'reply_to_message_id' => $this->replyToMessageId,
            'allow_sending_without_reply' => $this->allowSendingWithoutReply,
            'reply_markup' => $this->replyMarkup,
        ]);
    }

    public function method(): string
    {
        return 'sendVenue';
    }
}