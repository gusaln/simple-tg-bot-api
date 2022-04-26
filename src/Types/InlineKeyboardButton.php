<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\CallbackGame;
use GusALN\TelegramBotApi\Types\LoginUrl;
use GusALN\TelegramBotApi\Types\WebAppInfo;
use JsonSerializable;

/**
 * This object represents one button of an inline keyboard. You must use exactly one of the optional fields.
 */
class InlineKeyboardButton implements JsonSerializable
{
    /**
     * @param string $text Label text on the button
     * @param string|null $url Optional. HTTP or tg:// url to be opened when the button is pressed. Links tg://user?id=<user_id> can be used to mention a user by their ID without using a username, if this is allowed by their privacy settings.
     * @param string|null $callbackData Optional. Data to be sent in a callback query to the bot when button is pressed, 1-64 bytes
     * @param WebAppInfo|null $webApp Optional. Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery. Available only in private chats between a user and the bot.
     * @param LoginUrl|null $loginUrl Optional. An HTTP URL used to automatically authorize the user. Can be used as a replacement for the Telegram Login Widget.
     * @param string|null $switchInlineQuery Optional. If set, pressing the button will prompt the user to select one of their chats, open that chat and insert the bot's username and the specified inline query in the input field. Can be empty, in which case just the bot's username will be inserted.Note: This offers an easy way for users to start using your bot in inline mode when they are currently in a private chat with it. Especially useful when combined with switch_pm… actions – in this case the user will be automatically returned to the chat they switched from, skipping the chat selection screen.
     * @param string|null $switchInlineQueryCurrentChat Optional. If set, pressing the button will insert the bot's username and the specified inline query in the current chat's input field. Can be empty, in which case only the bot's username will be inserted.This offers a quick way for the user to open your bot in inline mode in the same chat – good for selecting something from multiple options.
     * @param CallbackGame|null $callbackGame Optional. Description of the game that will be launched when the user presses the button.NOTE: This type of button must always be the first button in the first row.
     * @param bool|null $pay Optional. Specify True, to send a Pay button.NOTE: This type of button must always be the first button in the first row and can only be used in invoice messages.
     */
    public function __construct(
        public string $text,
        public ?string $url = null,
        public ?string $callbackData = null,
        public ?WebAppInfo $webApp = null,
        public ?LoginUrl $loginUrl = null,
        public ?string $switchInlineQuery = null,
        public ?string $switchInlineQueryCurrentChat = null,
        public ?CallbackGame $callbackGame = null,
        public ?bool $pay = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['text'],
            $payload['url'] ?? null,
            $payload['callback_data'] ?? null,
            isset($payload['web_app']) ? WebAppInfo::fromPayload($payload['web_app']) : null,
            isset($payload['login_url']) ? LoginUrl::fromPayload($payload['login_url']) : null,
            $payload['switch_inline_query'] ?? null,
            $payload['switch_inline_query_current_chat'] ?? null,
            isset($payload['callback_game']) ? CallbackGame::fromPayload($payload['callback_game']) : null,
            $payload['pay'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'text' => $this->text,
            'url' => $this->url,
            'callback_data' => $this->callbackData,
            'web_app' => $this->webApp,
            'login_url' => $this->loginUrl,
            'switch_inline_query' => $this->switchInlineQuery,
            'switch_inline_query_current_chat' => $this->switchInlineQueryCurrentChat,
            'callback_game' => $this->callbackGame,
            'pay' => $this->pay,
        ]);
    }
}