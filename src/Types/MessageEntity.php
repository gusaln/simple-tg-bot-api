<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * This object represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 */
class MessageEntity implements JsonSerializable
{
    public const MESSAGE_MENTION_TYPE = "mention";
    public const MESSAGE_HASHTAG_TYPE = "hashtag";
    public const MESSAGE_CASHTAG_TYPE = "cashtag";
    public const MESSAGE_BOT_COMMAND_TYPE = "bot_command";
    public const MESSAGE_URL_TYPE = "url";
    public const MESSAGE_EMAIL_TYPE = "email";
    public const MESSAGE_PHONE_NUMBER_TYPE = "phone_number";
    public const MESSAGE_BOLD_TYPE = "bold";
    public const MESSAGE_ITALIC_TYPE = "italic";
    public const MESSAGE_UNDERLINE_TYPE = "underline";
    public const MESSAGE_STRIKETHROUGH_TYPE = "strikethrough";
    public const MESSAGE_SPOILER_TYPE = "spoiler";
    public const MESSAGE_CODE_TYPE = "code";
    public const MESSAGE_PRE_TYPE = "pre";
    public const MESSAGE_TEXT_LINK_TYPE = "text_link";
    public const MESSAGE_TEXT_MENTION_TYPE = "text_mention";

    /**
     * @param string $type Type of the entity. Currently, can be "mention" (@username), "hashtag" (#hashtag), "cashtag" ($USD), "bot_command" (/start@jobs_bot), "url" (https://telegram.org), "email" (do-not-reply@telegram.org), "phone_number" (+1-212-555-0123), "bold" (bold text), "italic" (italic text), "underline" (underlined text), "strikethrough" (strikethrough text), "spoiler" (spoiler message), "code" (monowidth string), "pre" (monowidth block), "text_link" (for clickable text URLs), "text_mention" (for users without usernames)
     * @param int $offset Offset in UTF-16 code units to the start of the entity
     * @param int $length Length of the entity in UTF-16 code units
     * @param string|null $url Optional. For "text_link" only, url that will be opened after user taps on the text
     * @param User|null $user Optional. For "text_mention" only, the mentioned user
     * @param string|null $language Optional. For "pre" only, the programming language of the entity text
     */
    public function __construct(
        public string $type,
        public int $offset,
        public int $length,
        public ?string $url = null,
        public ?User $user = null,
        public ?string $language = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['type'],
            $payload['offset'],
            $payload['length'],
            $payload['url'] ?? null,
            isset($payload['user']) ? User::fromPayload($payload['user']) : null,
            $payload['language'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'offset' => $this->offset,
            'length' => $this->length,
            'url' => $this->url,
            'user' => $this->user,
            'language' => $this->language,
        ]);
    }
}