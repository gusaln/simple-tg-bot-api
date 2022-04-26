<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use InvalidArgumentException;
use JsonSerializable;

/**
 * This object represents one result of an inline query. Telegram clients currently support results of the following 20 types:
 *
 * InlineQueryResultCachedAudio
 * InlineQueryResultCachedDocument
 * InlineQueryResultCachedGif
 * InlineQueryResultCachedMpeg4Gif
 * InlineQueryResultCachedPhoto
 * InlineQueryResultCachedSticker
 * InlineQueryResultCachedVideo
 * InlineQueryResultCachedVoice
 * InlineQueryResultArticle
 * InlineQueryResultAudio
 * InlineQueryResultContact
 * InlineQueryResultGame
 * InlineQueryResultDocument
 * InlineQueryResultGif
 * InlineQueryResultLocation
 * InlineQueryResultMpeg4Gif
 * InlineQueryResultPhoto
 * InlineQueryResultVenue
 * InlineQueryResultVideo
 * InlineQueryResultVoice
 *
 * Note: All URLs passed in inline query results will be available to end users and therefore must be assumed to be public.
 */
abstract class InlineQueryResult implements JsonSerializable
{
    public const INLINE_QUERY_RESULT_CACHED_AUDIO_TYPE = 'cached_audio';
    public const INLINE_QUERY_RESULT_CACHED_DOCUMENT_TYPE = 'cached_document';
    public const INLINE_QUERY_RESULT_CACHED_GIF_TYPE = 'cached_gif';
    public const INLINE_QUERY_RESULT_CACHED_MPEG4_GIF_TYPE = 'cached_mpeg4_gif';
    public const INLINE_QUERY_RESULT_CACHED_PHOTO_TYPE = 'cached_photo';
    public const INLINE_QUERY_RESULT_CACHED_STICKER_TYPE = 'cached_sticker';
    public const INLINE_QUERY_RESULT_CACHED_VIDEO_TYPE = 'cached_video';
    public const INLINE_QUERY_RESULT_CACHED_VOICE_TYPE = 'cached_voice';
    public const INLINE_QUERY_RESULT_ARTICLE_TYPE = 'article';
    public const INLINE_QUERY_RESULT_AUDIO_TYPE = 'audio';
    public const INLINE_QUERY_RESULT_CONTACT_TYPE = 'contact';
    public const INLINE_QUERY_RESULT_GAME_TYPE = 'game';
    public const INLINE_QUERY_RESULT_DOCUMENT_TYPE = 'document';
    public const INLINE_QUERY_RESULT_GIF_TYPE = 'gif';
    public const INLINE_QUERY_RESULT_LOCATION_TYPE = 'location';
    public const INLINE_QUERY_RESULT_MPEG4_GIF_TYPE = 'mpeg4_gif';
    public const INLINE_QUERY_RESULT_PHOTO_TYPE = 'photo';
    public const INLINE_QUERY_RESULT_VENUE_TYPE = 'venue';
    public const INLINE_QUERY_RESULT_VIDEO_TYPE = 'video';
    public const INLINE_QUERY_RESULT_VOICE_TYPE = 'voice';

    abstract public function type(): string;

    /** @phpstan-param array{type: string} $payload */
    public static function fromPayload(array $payload): self
    {
        return match($payload['type']) {
            'cached_audio' => InlineQueryResultCachedAudio::fromPayload($payload),
            'cached_document' => InlineQueryResultCachedDocument::fromPayload($payload),
            'cached_gif' => InlineQueryResultCachedGif::fromPayload($payload),
            'cached_mpeg4_gif' => InlineQueryResultCachedMpeg4Gif::fromPayload($payload),
            'cached_photo' => InlineQueryResultCachedPhoto::fromPayload($payload),
            'cached_sticker' => InlineQueryResultCachedSticker::fromPayload($payload),
            'cached_video' => InlineQueryResultCachedVideo::fromPayload($payload),
            'cached_voice' => InlineQueryResultCachedVoice::fromPayload($payload),
            'article' => InlineQueryResultArticle::fromPayload($payload),
            'audio' => InlineQueryResultAudio::fromPayload($payload),
            'contact' => InlineQueryResultContact::fromPayload($payload),
            'game' => InlineQueryResultGame::fromPayload($payload),
            'document' => InlineQueryResultDocument::fromPayload($payload),
            'gif' => InlineQueryResultGif::fromPayload($payload),
            'location' => InlineQueryResultLocation::fromPayload($payload),
            'mpeg4_gif' => InlineQueryResultMpeg4Gif::fromPayload($payload),
            'photo' => InlineQueryResultPhoto::fromPayload($payload),
            'venue' => InlineQueryResultVenue::fromPayload($payload),
            'video' => InlineQueryResultVideo::fromPayload($payload),
            'voice' => InlineQueryResultVoice::fromPayload($payload),
            default => throw new InvalidArgumentException(sprintf('Type %s is not a child of %s', $payload['type'], InlineQueryResult::class)),
        };
    }
}