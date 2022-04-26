<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\InputMessageContent;
use JsonSerializable;

/**
 * Represents a link to an article or web page.
 */
class InlineQueryResultArticle extends InlineQueryResult implements JsonSerializable
{
    private string $type = 'article';

    /**
     * @param string $id Unique identifier for this result, 1-64 Bytes
     * @param string $title Title of the result
     * @param InputMessageContent $inputMessageContent Content of the message to be sent
     * @param InlineKeyboardMarkup|null $replyMarkup Optional. Inline keyboard attached to the message
     * @param string|null $url Optional. URL of the result
     * @param bool|null $hideUrl Optional. Pass True, if you don't want the URL to be shown in the message
     * @param string|null $description Optional. Short description of the result
     * @param string|null $thumbUrl Optional. Url of the thumbnail for the result
     * @param int|null $thumbWidth Optional. Thumbnail width
     * @param int|null $thumbHeight Optional. Thumbnail height
     */
    public function __construct(
        public string $id,
        public string $title,
        public InputMessageContent $inputMessageContent,
        public ?InlineKeyboardMarkup $replyMarkup = null,
        public ?string $url = null,
        public ?bool $hideUrl = null,
        public ?string $description = null,
        public ?string $thumbUrl = null,
        public ?int $thumbWidth = null,
        public ?int $thumbHeight = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['id'],
            $payload['title'],
            InputMessageContent::fromPayload($payload['input_message_content']),
            isset($payload['reply_markup']) ? InlineKeyboardMarkup::fromPayload($payload['reply_markup']) : null,
            $payload['url'] ?? null,
            $payload['hide_url'] ?? null,
            $payload['description'] ?? null,
            $payload['thumb_url'] ?? null,
            $payload['thumb_width'] ?? null,
            $payload['thumb_height'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'id' => $this->id,
            'title' => $this->title,
            'input_message_content' => $this->inputMessageContent,
            'reply_markup' => $this->replyMarkup,
            'url' => $this->url,
            'hide_url' => $this->hideUrl,
            'description' => $this->description,
            'thumb_url' => $this->thumbUrl,
            'thumb_width' => $this->thumbWidth,
            'thumb_height' => $this->thumbHeight,
        ]);
    }

    /**
     * Type of the result, must be article.
     */
    public function type(): string
    {
        return $this->type;
    }
}