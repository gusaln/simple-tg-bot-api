<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\InputMessageContent;
use GusALN\TelegramBotApi\Types\MessageEntity;
use JsonSerializable;

/**
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption. Alternatively, you can use input_message_content to send a message with the specified content instead of the photo.
 */
class InlineQueryResultPhoto extends InlineQueryResult implements JsonSerializable
{
    private string $type = 'photo';

    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $photoUrl A valid URL of the photo. Photo must be in JPEG format. Photo size must not exceed 5MB
     * @param string $thumbUrl URL of the thumbnail for the photo
     * @param int|null $photoWidth Optional. Width of the photo
     * @param int|null $photoHeight Optional. Height of the photo
     * @param string|null $title Optional. Title for the result
     * @param string|null $description Optional. Short description of the result
     * @param string|null $caption Optional. Caption of the photo to be sent, 0-1024 characters after entities parsing
     * @param string|null $parseMode Optional. Mode for parsing entities in the photo caption. See formatting options for more details.
     * @param MessageEntity[]|null $captionEntities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     * @param InlineKeyboardMarkup|null $replyMarkup Optional. Inline keyboard attached to the message
     * @param InputMessageContent|null $inputMessageContent Optional. Content of the message to be sent instead of the photo
     */
    public function __construct(
        public string $id,
        public string $photoUrl,
        public string $thumbUrl,
        public ?int $photoWidth = null,
        public ?int $photoHeight = null,
        public ?string $title = null,
        public ?string $description = null,
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
            $payload['photo_url'],
            $payload['thumb_url'],
            $payload['photo_width'] ?? null,
            $payload['photo_height'] ?? null,
            $payload['title'] ?? null,
            $payload['description'] ?? null,
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
            'photo_url' => $this->photoUrl,
            'thumb_url' => $this->thumbUrl,
            'photo_width' => $this->photoWidth,
            'photo_height' => $this->photoHeight,
            'title' => $this->title,
            'description' => $this->description,
            'caption' => $this->caption,
            'parse_mode' => $this->parseMode,
            'caption_entities' => $this->captionEntities,
            'reply_markup' => $this->replyMarkup,
            'input_message_content' => $this->inputMessageContent,
        ]);
    }

    /**
     * Type of the result, must be photo.
     */
    public function type(): string
    {
        return $this->type;
    }
}