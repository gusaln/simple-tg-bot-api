<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a parameter of the inline keyboard button used to automatically authorize a user. Serves as a great replacement for the Telegram Login Widget when the user is coming from Telegram. All the user needs to do is tap/click a button and confirm that they want to log in:
 * Telegram apps support these buttons as of version 5.7.
 */
class LoginUrl implements JsonSerializable
{
    /**
     * @param string $url An HTTP URL to be opened with user authorization data added to the query string when the button is pressed. If the user refuses to provide authorization data, the original URL without information about the user will be opened. The data added is the same as described in Receiving authorization data.NOTE: You must always check the hash of the received data to verify the authentication and the integrity of the data as described in Checking authorization.
     * @param string|null $forwardText Optional. New text of the button in forwarded messages.
     * @param string|null $botUsername Optional. Username of a bot, which will be used for user authorization. See Setting up a bot for more details. If not specified, the current bot's username will be assumed. The url's domain must be the same as the domain linked with the bot. See Linking your domain to the bot for more details.
     * @param bool|null $requestWriteAccess Optional. Pass True to request the permission for your bot to send messages to the user.
     */
    public function __construct(
        public string $url,
        public ?string $forwardText = null,
        public ?string $botUsername = null,
        public ?bool $requestWriteAccess = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['url'],
            $payload['forward_text'] ?? null,
            $payload['bot_username'] ?? null,
            $payload['request_write_access'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'url' => $this->url,
            'forward_text' => $this->forwardText,
            'bot_username' => $this->botUsername,
            'request_write_access' => $this->requestWriteAccess,
        ]);
    }
}