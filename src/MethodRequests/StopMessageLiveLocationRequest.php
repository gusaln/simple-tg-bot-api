<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;

/**
 * Use this method to stop updating a live location message before live_period expires. On success, if the message is not an inline message, the edited Message is returned, otherwise True is returned.
 */
class StopMessageLiveLocationRequest extends MethodRequest
{
    /**
     * @param int|string|null $chatId Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $messageId Required if inline_message_id is not specified. Identifier of the message with live location to stop
     * @param string|null $inlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param InlineKeyboardMarkup|null $replyMarkup A JSON-serialized object for a new inline keyboard.
    */
    public function __construct(
        public int|string|null $chatId = null,
        public ?int $messageId = null,
        public ?string $inlineMessageId = null,
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
            isset($payload['reply_markup']) ? InlineKeyboardMarkup::fromPayload($payload['reply_markup']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
            'inline_message_id' => $this->inlineMessageId,
            'reply_markup' => $this->replyMarkup,
        ]);
    }

    public function method(): string
    {
        return 'stopMessageLiveLocation';
    }
}