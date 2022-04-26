<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\InputMessageContent;
use GusALN\TelegramBotApi\Types\MessageEntity;
use JsonSerializable;

/**
 * Represents a link to a page containing an embedded video player or a video file. By default, this video file will be sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the video.
 */
class InlineQueryResultVideo extends InlineQueryResult implements JsonSerializable
{
    private string $type = 'video';

    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $videoUrl A valid URL for the embedded video player or video file
     * @param string $mimeType Mime type of the content of video url, "text/html" or "video/mp4"
     * @param string $thumbUrl URL of the thumbnail (JPEG only) for the video
     * @param string $title Title for the result
     * @param string|null $caption Optional. Caption of the video to be sent, 0-1024 characters after entities parsing
     * @param string|null $parseMode Optional. Mode for parsing entities in the video caption. See formatting options for more details.
     * @param MessageEntity[]|null $captionEntities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param int|null $videoWidth Optional. Video width
     * @param int|null $videoHeight Optional. Video height
     * @param int|null $videoDuration Optional. Video duration in seconds
     * @param string|null $description Optional. Short description of the result
     * @param InlineKeyboardMarkup|null $replyMarkup Optional. Inline keyboard attached to the message
     * @param InputMessageContent|null $inputMessageContent Optional. Content of the message to be sent instead of the video. This field is required if InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video).
     */
    public function __construct(
        public string $id,
        public string $videoUrl,
        public string $mimeType,
        public string $thumbUrl,
        public string $title,
        public ?string $caption = null,
        public ?string $parseMode = null,
        public ?array $captionEntities = null,
        public ?int $videoWidth = null,
        public ?int $videoHeight = null,
        public ?int $videoDuration = null,
        public ?string $description = null,
        public ?InlineKeyboardMarkup $replyMarkup = null,
        public ?InputMessageContent $inputMessageContent = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['id'],
            $payload['video_url'],
            $payload['mime_type'],
            $payload['thumb_url'],
            $payload['title'],
            $payload['caption'] ?? null,
            $payload['parse_mode'] ?? null,
            isset($payload['caption_entities']) ? array_map(fn($t) => MessageEntity::fromPayload($t), $payload['caption_entities']) : null,
            $payload['video_width'] ?? null,
            $payload['video_height'] ?? null,
            $payload['video_duration'] ?? null,
            $payload['description'] ?? null,
            isset($payload['reply_markup']) ? InlineKeyboardMarkup::fromPayload($payload['reply_markup']) : null,
            isset($payload['input_message_content']) ? InputMessageContent::fromPayload($payload['input_message_content']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'id' => $this->id,
            'video_url' => $this->videoUrl,
            'mime_type' => $this->mimeType,
            'thumb_url' => $this->thumbUrl,
            'title' => $this->title,
            'caption' => $this->caption,
            'parse_mode' => $this->parseMode,
            'caption_entities' => $this->captionEntities,
            'video_width' => $this->videoWidth,
            'video_height' => $this->videoHeight,
            'video_duration' => $this->videoDuration,
            'description' => $this->description,
            'reply_markup' => $this->replyMarkup,
            'input_message_content' => $this->inputMessageContent,
        ]);
    }

    /**
     * Type of the result, must be video.
     */
    public function type(): string
    {
        return $this->type;
    }
}