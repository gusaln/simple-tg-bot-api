<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;

/**
 * Use this method to stop a poll which was sent by the bot. On success, the stopped Poll is returned.
 */
class StopPollRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int $messageId Identifier of the original message with the poll
     * @param InlineKeyboardMarkup|null $replyMarkup A JSON-serialized object for a new message inline keyboard.
    */
    public function __construct(
        public int|string $chatId,
        public int $messageId,
        public ?InlineKeyboardMarkup $replyMarkup = null,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['chat_id'],
            $payload['message_id'],
            $payload['reply_markup'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
            'reply_markup' => $this->replyMarkup,
        ]);
    }

    public function method(): string
    {
        return 'stopPoll';
    }
}