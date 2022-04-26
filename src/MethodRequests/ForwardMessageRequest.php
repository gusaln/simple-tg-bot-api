<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to forward messages of any kind. Service messages can't be forwarded. On success, the sent Message is returned.
 */
class ForwardMessageRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param int|string $fromChatId Unique identifier for the chat where the original message was sent (or channel username in the format @channelusername)
     * @param bool|null $disableNotification Sends the message silently. Users will receive a notification with no sound.
     * @param bool|null $protectContent Protects the contents of the forwarded message from forwarding and saving
     * @param int $messageId Message identifier in the chat specified in from_chat_id
    */
    public function __construct(
        public int|string $chatId,
        public int|string $fromChatId,
        public ?bool $disableNotification = null,
        public ?bool $protectContent = null,
        public int $messageId,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['chat_id'],
            $payload['from_chat_id'],
            $payload['disable_notification'],
            $payload['protect_content'],
            $payload['message_id'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'from_chat_id' => $this->fromChatId,
            'disable_notification' => $this->disableNotification,
            'protect_content' => $this->protectContent,
            'message_id' => $this->messageId,
        ]);
    }

    public function method(): string
    {
        return 'forwardMessage';
    }
}