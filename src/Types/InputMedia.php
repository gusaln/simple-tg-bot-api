<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use InvalidArgumentException;
use JsonSerializable;

/**
 * This object represents the content of a media message to be sent. It should be one of
 *
 * InputMediaAnimation
 * InputMediaDocument
 * InputMediaAudio
 * InputMediaPhoto
 * InputMediaVideo
 *
 */
abstract class InputMedia implements JsonSerializable
{
    public const INPUT_MEDIA_ANIMATION_TYPE = 'animation';
    public const INPUT_MEDIA_DOCUMENT_TYPE = 'document';
    public const INPUT_MEDIA_AUDIO_TYPE = 'audio';
    public const INPUT_MEDIA_PHOTO_TYPE = 'photo';
    public const INPUT_MEDIA_VIDEO_TYPE = 'video';

    abstract public function type(): string;

    /** @phpstan-param array{type: string} $payload */
    public static function fromPayload(array $payload): self
    {
        return match($payload['type']) {
            'animation' => InputMediaAnimation::fromPayload($payload),
            'document' => InputMediaDocument::fromPayload($payload),
            'audio' => InputMediaAudio::fromPayload($payload),
            'photo' => InputMediaPhoto::fromPayload($payload),
            'video' => InputMediaVideo::fromPayload($payload),
            default => throw new InvalidArgumentException(sprintf('Type %s is not a child of %s', $payload['type'], InputMedia::class)),
        };
    }
}