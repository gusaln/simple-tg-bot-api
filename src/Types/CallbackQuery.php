<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\Message;
use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * This object represents an incoming callback query from a callback button in an inline keyboard. If the button that originated the query was attached to a message sent by the bot, the field message will be present. If the button was attached to a message sent via the bot (in inline mode), the field inline_message_id will be present. Exactly one of the fields data or game_short_name will be present.
 */
class CallbackQuery implements JsonSerializable
{
    /**
     * @param string $id Unique identifier for this query
     * @param User $from Sender
     * @param Message|null $message Optional. Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old
     * @param string|null $inlineMessageId Optional. Identifier of the message sent via the bot in inline mode, that originated the query.
     * @param string $chatInstance Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games.
     * @param string|null $data Optional. Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field.
     * @param string|null $gameShortName Optional. Short name of a Game to be returned, serves as the unique identifier for the game
     */
    public function __construct(
        public string $id,
        public User $from,
        public ?Message $message = null,
        public ?string $inlineMessageId = null,
        public string $chatInstance,
        public ?string $data = null,
        public ?string $gameShortName = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['id'],
            User::fromPayload($payload['from']),
            isset($payload['message']) ? Message::fromPayload($payload['message']) : null,
            $payload['inline_message_id'] ?? null,
            $payload['chat_instance'],
            $payload['data'] ?? null,
            $payload['game_short_name'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'id' => $this->id,
            'from' => $this->from,
            'message' => $this->message,
            'inline_message_id' => $this->inlineMessageId,
            'chat_instance' => $this->chatInstance,
            'data' => $this->data,
            'game_short_name' => $this->gameShortName,
        ]);
    }
}