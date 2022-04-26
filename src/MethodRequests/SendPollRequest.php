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
 * Use this method to send a native poll. On success, the sent Message is returned.
 */
class SendPollRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $question Poll question, 1-300 characters
     * @param string[] $options A JSON-serialized list of answer options, 2-10 strings 1-100 characters each
     * @param bool|null $isAnonymous True, if the poll needs to be anonymous, defaults to True
     * @param string|null $type Poll type, "quiz" or "regular", defaults to "regular"
     * @param bool|null $allowsMultipleAnswers True, if the poll allows multiple answers, ignored for polls in quiz mode, defaults to False
     * @param int|null $correctOptionId 0-based identifier of the correct answer option, required for polls in quiz mode
     * @param string|null $explanation Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters with at most 2 line feeds after entities parsing
     * @param string|null $explanationParseMode Mode for parsing entities in the explanation. See formatting options for more details.
     * @param MessageEntity[]|null $explanationEntities A JSON-serialized list of special entities that appear in the poll explanation, which can be specified instead of parse_mode
     * @param int|null $openPeriod Amount of time in seconds the poll will be active after creation, 5-600. Can't be used together with close_date.
     * @param int|null $closeDate Point in time (Unix timestamp) when the poll will be automatically closed. Must be at least 5 and no more than 600 seconds in the future. Can't be used together with open_period.
     * @param bool|null $isClosed Pass True, if the poll needs to be immediately closed. This can be useful for poll preview.
     * @param bool|null $disableNotification Sends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protectContent Protects the contents of the sent message from forwarding and saving
     * @param int|null $replyToMessageId If the message is a reply, ID of the original message
     * @param bool|null $allowSendingWithoutReply Pass True, if the message should be sent even if the specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
    */
    public function __construct(
        public int|string $chatId,
        public string $question,
        public array $options,
        public ?bool $isAnonymous = null,
        public ?string $type = null,
        public ?bool $allowsMultipleAnswers = null,
        public ?int $correctOptionId = null,
        public ?string $explanation = null,
        public ?string $explanationParseMode = null,
        public ?array $explanationEntities = null,
        public ?int $openPeriod = null,
        public ?int $closeDate = null,
        public ?bool $isClosed = null,
        public ?bool $disableNotification = null,
        public ?bool $protectContent = null,
        public ?int $replyToMessageId = null,
        public ?bool $allowSendingWithoutReply = null,
        public InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup = null,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['chat_id'],
            $payload['question'],
            $payload['options'],
            $payload['is_anonymous'],
            $payload['type'],
            $payload['allows_multiple_answers'],
            $payload['correct_option_id'],
            $payload['explanation'],
            $payload['explanation_parse_mode'],
            $payload['explanation_entities'],
            $payload['open_period'],
            $payload['close_date'],
            $payload['is_closed'],
            $payload['disable_notification'],
            $payload['protect_content'],
            $payload['reply_to_message_id'],
            $payload['allow_sending_without_reply'],
            $payload['reply_markup'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'question' => $this->question,
            'options' => $this->options,
            'is_anonymous' => $this->isAnonymous,
            'type' => $this->type,
            'allows_multiple_answers' => $this->allowsMultipleAnswers,
            'correct_option_id' => $this->correctOptionId,
            'explanation' => $this->explanation,
            'explanation_parse_mode' => $this->explanationParseMode,
            'explanation_entities' => $this->explanationEntities,
            'open_period' => $this->openPeriod,
            'close_date' => $this->closeDate,
            'is_closed' => $this->isClosed,
            'disable_notification' => $this->disableNotification,
            'protect_content' => $this->protectContent,
            'reply_to_message_id' => $this->replyToMessageId,
            'allow_sending_without_reply' => $this->allowSendingWithoutReply,
            'reply_markup' => $this->replyMarkup,
        ]);
    }

    public function method(): string
    {
        return 'sendPoll';
    }
}