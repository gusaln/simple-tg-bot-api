<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\MessageEntity;

/**
 * Use this method to edit text and game messages. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
 */
class EditMessageTextRequest extends MethodRequest
{
    /**
     * @param int|string|null $chatId Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $messageId Required if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param string $text New text of the message, 1-4096 characters after entities parsing
     * @param string|null $parseMode Mode for parsing entities in the message text. See formatting options for more details.
     * @param MessageEntity[]|null $entities A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
     * @param bool|null $disableWebPagePreview Disables link previews for links in this message
     * @param InlineKeyboardMarkup|null $replyMarkup A JSON-serialized object for an inline keyboard.
    */
    public function __construct(
        public int|string|null $chatId = null,
        public ?int $messageId = null,
        public ?string $inlineMessageId = null,
        public string $text,
        public ?string $parseMode = null,
        public ?array $entities = null,
        public ?bool $disableWebPagePreview = null,
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
            $payload['text'],
            $payload['parse_mode'] ?? null,
            isset($payload['entities']) ? array_map(fn($t) => MessageEntity::fromPayload($t), $payload['entities']) : null,
            $payload['disable_web_page_preview'] ?? null,
            isset($payload['reply_markup']) ? InlineKeyboardMarkup::fromPayload($payload['reply_markup']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
            'inline_message_id' => $this->inlineMessageId,
            'text' => $this->text,
            'parse_mode' => $this->parseMode,
            'entities' => $this->entities,
            'disable_web_page_preview' => $this->disableWebPagePreview,
            'reply_markup' => $this->replyMarkup,
        ]);
    }

    public function method(): string
    {
        return 'editMessageText';
    }
}