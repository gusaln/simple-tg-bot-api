<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\InputMessageContent;
use GusALN\TelegramBotApi\Types\MessageEntity;
use JsonSerializable;

/**
 * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the animation.
 */
class InlineQueryResultGif extends InlineQueryResult implements JsonSerializable
{
    private string $type = 'gif';

    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $gifUrl A valid URL for the GIF file. File size must not exceed 1MB
     * @param int|null $gifWidth Optional. Width of the GIF
     * @param int|null $gifHeight Optional. Height of the GIF
     * @param int|null $gifDuration Optional. Duration of the GIF in seconds
     * @param string $thumbUrl URL of the static (JPEG or GIF) or animated (MPEG4) thumbnail for the result
     * @param string|null $thumbMimeType Optional. MIME type of the thumbnail, must be one of "image/jpeg", "image/gif", or "video/mp4". Defaults to "image/jpeg"
     * @param string|null $title Optional. Title for the result
     * @param string|null $caption Optional. Caption of the GIF file to be sent, 0-1024 characters after entities parsing
     * @param string|null $parseMode Optional. Mode for parsing entities in the caption. See formatting options for more details.
     * @param MessageEntity[]|null $captionEntities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param InlineKeyboardMarkup|null $replyMarkup Optional. Inline keyboard attached to the message
     * @param InputMessageContent|null $inputMessageContent Optional. Content of the message to be sent instead of the GIF animation
     */
    public function __construct(
        public string $id,
        public string $gifUrl,
        public ?int $gifWidth = null,
        public ?int $gifHeight = null,
        public ?int $gifDuration = null,
        public string $thumbUrl,
        public ?string $thumbMimeType = null,
        public ?string $title = null,
        public ?string $caption = null,
        public ?string $parseMode = null,
        public ?array $captionEntities = null,
        public ?InlineKeyboardMarkup $replyMarkup = null,
        public ?InputMessageContent $inputMessageContent = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['id'],
            $payload['gif_url'],
            $payload['gif_width'] ?? null,
            $payload['gif_height'] ?? null,
            $payload['gif_duration'] ?? null,
            $payload['thumb_url'],
            $payload['thumb_mime_type'] ?? null,
            $payload['title'] ?? null,
            $payload['caption'] ?? null,
            $payload['parse_mode'] ?? null,
            isset($payload['caption_entities']) ? array_map(fn($t) => MessageEntity::fromPayload($t), $payload['caption_entities']) : null,
            isset($payload['reply_markup']) ? InlineKeyboardMarkup::fromPayload($payload['reply_markup']) : null,
            isset($payload['input_message_content']) ? InputMessageContent::fromPayload($payload['input_message_content']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'id' => $this->id,
            'gif_url' => $this->gifUrl,
            'gif_width' => $this->gifWidth,
            'gif_height' => $this->gifHeight,
            'gif_duration' => $this->gifDuration,
            'thumb_url' => $this->thumbUrl,
            'thumb_mime_type' => $this->thumbMimeType,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parseMode,
            'caption_entities' => $this->captionEntities,
            'reply_markup' => $this->replyMarkup,
            'input_message_content' => $this->inputMessageContent,
        ]);
    }

    /**
     * Type of the result, must be gif.
     */
    public function type(): string
    {
        return $this->type;
    }
}