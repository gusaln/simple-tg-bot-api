<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\KeyboardButtonPollType;
use GusALN\TelegramBotApi\Types\WebAppInfo;
use JsonSerializable;

/**
 * This object represents one button of the reply keyboard. For simple text buttons String can be used instead of this object to specify text of the button. Optional fields web_app, request_contact, request_location, and request_poll are mutually exclusive.
 * Note: request_contact and request_location options will only work in Telegram versions released after 9 April, 2016. Older clients will display unsupported message.Note: request_poll option will only work in Telegram versions released after 23 January, 2020. Older clients will display unsupported message.Note: web_app option will only work in Telegram versions released after 16 April, 2022. Older clients will display unsupported message.
 */
class KeyboardButton implements JsonSerializable
{
    /**
     * @param string $text Text of the button. If none of the optional fields are used, it will be sent as a message when the button is pressed
     * @param bool|null $requestContact Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in private chats only.
     * @param bool|null $requestLocation Optional. If True, the user's current location will be sent when the button is pressed. Available in private chats only.
     * @param KeyboardButtonPollType|null $requestPoll Optional. If specified, the user will be asked to create a poll and send it to the bot when the button is pressed. Available in private chats only.
     * @param WebAppInfo|null $webApp Optional. If specified, the described Web App will be launched when the button is pressed. The Web App will be able to send a "web_app_data" service message. Available in private chats only.
     */
    public function __construct(
        public string $text,
        public ?bool $requestContact = null,
        public ?bool $requestLocation = null,
        public ?KeyboardButtonPollType $requestPoll = null,
        public ?WebAppInfo $webApp = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['text'],
            $payload['request_contact'] ?? null,
            $payload['request_location'] ?? null,
            isset($payload['request_poll']) ? KeyboardButtonPollType::fromPayload($payload['request_poll']) : null,
            isset($payload['web_app']) ? WebAppInfo::fromPayload($payload['web_app']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'text' => $this->text,
            'request_contact' => $this->requestContact,
            'request_location' => $this->requestLocation,
            'request_poll' => $this->requestPoll,
            'web_app' => $this->webApp,
        ]);
    }
}