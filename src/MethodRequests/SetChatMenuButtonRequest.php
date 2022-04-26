<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\MenuButton;

/**
 * Use this method to change the bot's menu button in a private chat, or the default menu button. Returns True on success.
 */
class SetChatMenuButtonRequest extends MethodRequest
{
    /**
     * @param int|null $chatId Unique identifier for the target private chat. If not specified, default bot's menu button will be changed
     * @param MenuButton|null $menuButton A JSON-serialized object for the new bot's menu button. Defaults to MenuButtonDefault
    */
    public function __construct(
        public ?int $chatId = null,
        public ?MenuButton $menuButton = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'] ?? null,
            isset($payload['menu_button']) ? MenuButton::fromPayload($payload['menu_button']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'menu_button' => $this->menuButton,
        ]);
    }

    public function method(): string
    {
        return 'setChatMenuButton';
    }
}