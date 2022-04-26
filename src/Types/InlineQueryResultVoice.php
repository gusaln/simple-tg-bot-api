<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\InputMessageContent;
use GusALN\TelegramBotApi\Types\MessageEntity;
use JsonSerializable;

/**
 * Represents a link to a voice recording in an .OGG container encoded with OPUS. By default, this voice recording will be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content instead of the the voice message.
 * Note: This will only work in Telegram versions released after 9 April, 2016. Older clients will ignore them.
 */
class InlineQueryResultVoice extends InlineQueryResult implements JsonSerializable
{
    private string $type = 'voice';

    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $voiceUrl A valid URL for the voice recording
     * @param string $title Recording title
     * @param string|null $caption Optional. Caption, 0-1024 characters after entities parsing
     * @param string|null $parseMode Optional. Mode for parsing entities in the voice message caption. See formatting options for more details.
     * @param MessageEntity[]|null $captionEntities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param int|null $voiceDuration Optional. Recording duration in seconds
     * @param InlineKeyboardMarkup|null $replyMarkup Optional. Inline keyboard attached to the message
     * @param InputMessageContent|null $inputMessageContent Optional. Content of the message to be sent instead of the voice recording
     */
    public function __construct(
        public string $id,
        public string $voiceUrl,
        public string $title,
        public ?string $caption = null,
        public ?string $parseMode = null,
        public ?array $captionEntities = null,
        public ?int $voiceDuration = null,
        public ?InlineKeyboardMarkup $replyMarkup = null,
        public ?InputMessageContent $inputMessageContent = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['id'],
            $payload['voice_url'],
            $payload['title'],
            $payload['caption'] ?? null,
            $payload['parse_mode'] ?? null,
            isset($payload['caption_entities']) ? array_map(fn($t) => MessageEntity::fromPayload($t), $payload['caption_entities']) : null,
            $payload['voice_duration'] ?? null,
            isset($payload['reply_markup']) ? InlineKeyboardMarkup::fromPayload($payload['reply_markup']) : null,
            isset($payload['input_message_content']) ? InputMessageContent::fromPayload($payload['input_message_content']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'id' => $this->id,
            'voice_url' => $this->voiceUrl,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parseMode,
            'caption_entities' => $this->captionEntities,
            'voice_duration' => $this->voiceDuration,
            'reply_markup' => $this->replyMarkup,
            'input_message_content' => $this->inputMessageContent,
        ]);
    }

    /**
     * Type of the result, must be voice.
     */
    public function type(): string
    {
        return $this->type;
    }
}