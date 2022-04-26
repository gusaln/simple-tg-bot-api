<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use InvalidArgumentException;
use JsonSerializable;

/**
 * This object describes the bot's menu button in a private chat. It should be one of
 *
 * MenuButtonCommands
 * MenuButtonWebApp
 * MenuButtonDefault
 *
 * If a menu button other than MenuButtonDefault is set for a private chat, then it is applied in the chat. Otherwise the default menu button is applied. By default, the menu button opens the list of bot commands.
 */
abstract class MenuButton implements JsonSerializable
{
    public const MENU_BUTTON_COMMANDS_TYPE = 'commands';
    public const MENU_BUTTON_WEB_APP_TYPE = 'web_app';
    public const MENU_BUTTON_DEFAULT_TYPE = 'default';

    abstract public function type(): string;

    /** @phpstan-param array{type: string} $payload */
    public static function fromPayload(array $payload): self
    {
        return match($payload['type']) {
            'commands' => MenuButtonCommands::fromPayload($payload),
            'web_app' => MenuButtonWebApp::fromPayload($payload),
            'default' => MenuButtonDefault::fromPayload($payload),
            default => throw new InvalidArgumentException(sprintf('Type %s is not a child of %s', $payload['type'], MenuButton::class)),
        };
    }
}