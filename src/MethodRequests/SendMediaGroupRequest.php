<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InputMediaAudio;

/**
 * Use this method to send a group of photos, videos, documents or audios as an album. Documents and audio files can be only grouped in an album with messages of the same type. On success, an array of Messages that were sent is returned.
 */
class SendMediaGroupRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier for the target chat or username of the target channel (in the format @channelusername)
     * @param InputMediaAudio[] $media A JSON-serialized array describing messages to be sent, must include 2-10 items
     * @param bool|null $disableNotification Sends messages silently. Users will receive a notification with no sound.
     * @param bool|null $protectContent Protects the contents of the sent messages from forwarding and saving
     * @param int|null $replyToMessageId If the messages are a reply, ID of the original message
     * @param bool|null $allowSendingWithoutReply Pass True, if the message should be sent even if the specified replied-to message is not found
    */
    public function __construct(
        public int|string $chatId,
        public array $media,
        public ?bool $disableNotification = null,
        public ?bool $protectContent = null,
        public ?int $replyToMessageId = null,
        public ?bool $allowSendingWithoutReply = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['chat_id'],
            array_map(fn($t) => InputMediaAudio::fromPayload($t), $payload['media']),
            $payload['disable_notification'] ?? null,
            $payload['protect_content'] ?? null,
            $payload['reply_to_message_id'] ?? null,
            $payload['allow_sending_without_reply'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'media' => $this->media,
            'disable_notification' => $this->disableNotification,
            'protect_content' => $this->protectContent,
            'reply_to_message_id' => $this->replyToMessageId,
            'allow_sending_without_reply' => $this->allowSendingWithoutReply,
        ]);
    }

    public function method(): string
    {
        return 'sendMediaGroup';
    }
}