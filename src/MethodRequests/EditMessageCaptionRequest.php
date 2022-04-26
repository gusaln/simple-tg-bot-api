<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\MessageEntity;

/**
 * Use this method to edit captions of messages. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
 */
class EditMessageCaptionRequest extends MethodRequest
{
    /**
     * @param int|string|null $chatId Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|null $messageId Required if inline_message_id is not specified. Identifier of the message to edit
     * @param string|null $inlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
     * @param string|null $caption New caption of the message, 0-1024 characters after entities parsing
     * @param string|null $parseMode Mode for parsing entities in the message caption. See formatting options for more details.
     * @param MessageEntity[]|null $captionEntities A JSON-serialized list of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param InlineKeyboardMarkup|null $replyMarkup A JSON-serialized object for an inline keyboard.
    */
    public function __construct(
        public int|string|null $chatId = null,
        public ?int $messageId = null,
        public ?string $inlineMessageId = null,
        public ?string $caption = null,
        public ?string $parseMode = null,
        public ?array $captionEntities = null,
        public ?InlineKeyboardMarkup $replyMarkup = null,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['chat_id'],
            $payload['message_id'],
            $payload['inline_message_id'],
            $payload['caption'],
            $payload['parse_mode'],
            $payload['caption_entities'],
            $payload['reply_markup'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
            'inline_message_id' => $this->inlineMessageId,
            'caption' => $this->caption,
            'parse_mode' => $this->parseMode,
            'caption_entities' => $this->captionEntities,
            'reply_markup' => $this->replyMarkup,
        ]);
    }

    public function method(): string
    {
        return 'editMessageCaption';
    }
}