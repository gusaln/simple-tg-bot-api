<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\ForceReply;
use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\MessageEntity;
use GusALN\TelegramBotApi\Types\ReplyKeyboardMarkup;
use GusALN\TelegramBotApi\Types\ReplyKeyboardRemove;

/**
 * Use this method to send text messages. On success, the sent Message is returned.
 */
class SendMessageRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $text Text of the message to be sent, 1-4096 characters after entities parsing
     * @param string|null $parseMode Mode for parsing entities in the message text. See formatting options for more details.
     * @param MessageEntity[]|null $entities A JSON-serialized list of special entities that appear in message text, which can be specified instead of parse_mode
     * @param bool|null $disableWebPagePreview Disables link previews for links in this message
     * @param bool|null $disableNotification Sends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protectContent Protects the contents of the sent message from forwarding and saving
     * @param int|null $replyToMessageId If the message is a reply, ID of the original message
     * @param bool|null $allowSendingWithoutReply Pass True, if the message should be sent even if the specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
    */
    public function __construct(
        public int|string $chatId,
        public string $text,
        public ?string $parseMode = null,
        public ?array $entities = null,
        public ?bool $disableWebPagePreview = null,
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
            $payload['text'],
            $payload['parse_mode'] ?? null,
            isset($payload['entities']) ? array_map(fn($t) => MessageEntity::fromPayload($t), $payload['entities']) : null,
            $payload['disable_web_page_preview'] ?? null,
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
            'text' => $this->text,
            'parse_mode' => $this->parseMode,
            'entities' => $this->entities,
            'disable_web_page_preview' => $this->disableWebPagePreview,
            'disable_notification' => $this->disableNotification,
            'protect_content' => $this->protectContent,
            'reply_to_message_id' => $this->replyToMessageId,
            'allow_sending_without_reply' => $this->allowSendingWithoutReply,
            'reply_markup' => $this->replyMarkup,
        ]);
    }

    public function method(): string
    {
        return 'sendMessage';
    }
}