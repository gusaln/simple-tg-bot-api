<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\CodeGeneration;

const TYPES_CACHE = __DIR__.'/../../types/types.json';

const METHODS_CACHE = __DIR__.'/../../types/methods.json';

const ABSTRACT_TYPES = [
    'ChatMember' => [
        'property' => 'status',
        'childrenMap' => [
            'creator' => 'ChatMemberOwner',
            'administrator' => 'ChatMemberAdministrator',
            'member' => 'ChatMemberMember',
            'restricted' => 'ChatMemberRestricted',
            'left' => 'ChatMemberLeft',
            'kicked' => 'ChatMemberBanned',
        ],
    ],
    'BotCommandScope' => [
        'property' => 'type',
        'childrenMap' => [
            'default' => 'BotCommandScopeDefault',
            'all_private_chats' => 'BotCommandScopeAllPrivateChats',
            'all_group_chats' => 'BotCommandScopeAllGroupChats',
            'all_chat_administrators' => 'BotCommandScopeAllChatAdministrators',
            'chat' => 'BotCommandScopeChat',
            'chat_administrators' => 'BotCommandScopeChatAdministrators',
            'chat_member' => 'BotCommandScopeChatMember',
        ],
    ],
    'MenuButton' => [
        'property' => 'type',
        'childrenMap' => [
            'commands' => 'MenuButtonCommands',
            'web_app' => 'MenuButtonWebApp',
            'default' => 'MenuButtonDefault',
        ],
    ],
    'InputMedia' => [
        'property' => 'type',
        'childrenMap' => [
            'animation' => 'InputMediaAnimation',
            'document' => 'InputMediaDocument',
            'audio' => 'InputMediaAudio',
            'photo' => 'InputMediaPhoto',
            'video' => 'InputMediaVideo',
        ],
    ],
    'InlineQueryResult' => [
        'property' => 'type',
        'childrenMap' => [
            // @FIXME
            // The cached variants share the same types which means this will not map in the right way.
            'cached_audio' => 'InlineQueryResultCachedAudio',
            'cached_document' => 'InlineQueryResultCachedDocument',
            'cached_gif' => 'InlineQueryResultCachedGif',
            'cached_mpeg4_gif' => 'InlineQueryResultCachedMpeg4Gif',
            'cached_photo' => 'InlineQueryResultCachedPhoto',
            'cached_sticker' => 'InlineQueryResultCachedSticker',
            'cached_video' => 'InlineQueryResultCachedVideo',
            'cached_voice' => 'InlineQueryResultCachedVoice',
            'article' => 'InlineQueryResultArticle',
            'audio' => 'InlineQueryResultAudio',
            'contact' => 'InlineQueryResultContact',
            'game' => 'InlineQueryResultGame',
            'document' => 'InlineQueryResultDocument',
            'gif' => 'InlineQueryResultGif',
            'location' => 'InlineQueryResultLocation',
            'mpeg4_gif' => 'InlineQueryResultMpeg4Gif',
            'photo' => 'InlineQueryResultPhoto',
            'venue' => 'InlineQueryResultVenue',
            'video' => 'InlineQueryResultVideo',
            'voice' => 'InlineQueryResultVoice',
        ],
    ],
    'PassportElementError' => [
        'property' => 'source',
        'childrenMap' => [
            'data' => 'PassportElementErrorDataField',
            'front_side' => 'PassportElementErrorFrontSide',
            'reverse_side' => 'PassportElementErrorReverseSide',
            'selfie' => 'PassportElementErrorSelfie',
            'file' => 'PassportElementErrorFile',
            'files' => 'PassportElementErrorFiles',
            'translation_file' => 'PassportElementErrorTranslationFile',
            'translation_files' => 'PassportElementErrorTranslationFiles',
            'unspecified' => 'PassportElementErrorUnspecified',
        ],
    ],
    // This type is special because there is no `type` property in the children.
    // However, every child type has at least one property unique to that child type.
    'InputMessageContent' => [
        'childHasUniqueProperty' => true,
        'childrenMap' => [
            'message_text' => 'InputTextMessageContent',
            'proximity_alert_radius' => 'InputLocationMessageContent',
            'address' => 'InputVenueMessageContent',
            'phone_number' => 'InputContactMessageContent',
            'prices' => 'InputInvoiceMessageContent',
        ],
    ],
];

function is_abstract_type(string $string): bool
{
    return isset(ABSTRACT_TYPES[$string]);
}

function abstract_has_type_property(string $abstractType): bool
{
    return isset(ABSTRACT_TYPES[$abstractType]['property']);
}

/**
 * @return array<string,string>
 */
function get_children_map_of_abstract_type(string $abstractType): array
{
    return isset(ABSTRACT_TYPES[$abstractType], ABSTRACT_TYPES[$abstractType]['childrenMap'])
        ? ABSTRACT_TYPES[$abstractType]['childrenMap']
        : [];
}

function get_type_property_of_abstract_type(?string $abstractType): ?string
{
    return $abstractType && isset(ABSTRACT_TYPES[$abstractType], ABSTRACT_TYPES[$abstractType]['property'])
        ? ABSTRACT_TYPES[$abstractType]['property']
        : null;
}

function camel_case(string $string): string
{
    $parts = explode('_', $string);

    return $parts[0].implode('', array_map(fn ($s) => ucfirst($s), array_slice($parts, 1)));
}

function snake_case(string $string): string
{
    $delimiter = '_';

    if (! ctype_lower($string)) {
        $string = preg_replace('/\s+/u', '', ucwords($string));

        $string = strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, $string));
    }

    return $string;
}

function escape_string(string $string): string
{
    return str_replace(['“', '”'], ['"', '"'], $string);
}
