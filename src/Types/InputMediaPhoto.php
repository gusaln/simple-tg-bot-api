<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\MessageEntity;
use JsonSerializable;

/**
 * Represents a photo to be sent.
 */
class InputMediaPhoto extends InputMedia implements JsonSerializable
{
    private string $type = 'photo';

    /**
     * @param string $media File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass "attach://<file_attach_name>" to upload a new one using multipart/form-data under <file_attach_name> name. More info on Sending Files »
     * @param string|null $caption Optional. Caption of the photo to be sent, 0-1024 characters after entities parsing
     * @param string|null $parseMode Optional. Mode for parsing entities in the photo caption. See formatting options for more details.
     * @param MessageEntity[]|null $captionEntities Optional. List of special entities that appear in the caption, which can be specified instead of parse_mode
     */
    public function __construct(
        public string $media,
        public ?string $caption = null,
        public ?string $parseMode = null,
        public ?array $captionEntities = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['media'],
            $payload['caption'] ?? null,
            $payload['parse_mode'] ?? null,
            isset($payload['caption_entities']) ? array_map(fn($t) => MessageEntity::fromPayload($t), $payload['caption_entities']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'media' => $this->media,
            'caption' => $this->caption,
            'parse_mode' => $this->parseMode,
            'caption_entities' => $this->captionEntities,
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