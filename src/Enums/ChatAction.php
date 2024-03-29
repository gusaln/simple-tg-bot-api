<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Enums;

class ChatAction
{
    public const TYPING = 'typing';
    public const UPLOAD_PHOTO = 'upload_photo';
    public const RECORD_VIDEO = 'record_video';
    public const UPLOAD_VIDEO = 'upload_video';
    public const RECORD_VOICE = 'record_voice';
    public const UPLOAD_VOICE = 'upload_voice';
    public const UPLOAD_DOCUMENT = 'upload_document';
    public const CHOOSE_STICKER = 'choose_sticker';
    public const FIND_LOCATION = 'find_location';
    public const RECORD_VIDEO_NOTE = 'record_video_note';
    public const UPLOAD_VIDEO_NOTE = 'upload_video_note';
}
