<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\ForceReply;
use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\ReplyKeyboardMarkup;
use GusALN\TelegramBotApi\Types\ReplyKeyboardRemove;

/**
 * Use this method to send phone contacts. On success, the sent Message is returned.
 */
class SendContactRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param string $phoneNumber Contact's phone number
     * @param string $firstName Contact's first name
     * @param string|null $lastName Contact's last name
     * @param string|null $vcard Additional data about the contact in the form of a vCard, 0-2048 bytes
     * @param bool|null $disableNotification Sends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protectContent Protects the contents of the sent message from forwarding and saving
     * @param int|null $replyToMessageId If the message is a reply, ID of the original message
     * @param bool|null $allowSendingWithoutReply Pass True, if the message should be sent even if the specified replied-to message is not found
     * @param InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply|null $replyMarkup Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove keyboard or to force a reply from the user.
    */
    public function __construct(
        public int|string $chatId,
        public string $phoneNumber,
        public string $firstName,
        public ?string $lastName = null,
        public ?string $vcard = null,
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
            $payload['phone_number'],
            $payload['first_name'],
            $payload['last_name'] ?? null,
            $payload['vcard'] ?? null,
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
            'phone_number' => $this->phoneNumber,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'vcard' => $this->vcard,
            'disable_notification' => $this->disableNotification,
            'protect_content' => $this->protectContent,
            'reply_to_message_id' => $this->replyToMessageId,
            'allow_sending_without_reply' => $this->allowSendingWithoutReply,
            'reply_markup' => $this->replyMarkup,
        ]);
    }

    public function method(): string
    {
        return 'sendContact';
    }
}