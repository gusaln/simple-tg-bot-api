<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\WebAppInfo;
use JsonSerializable;

/**
 * Represents a menu button, which launches a Web App.
 */
class MenuButtonWebApp extends MenuButton implements JsonSerializable
{
    private string $type = 'web_app';

    /**
     * @param string $text Text on the button
     * @param WebAppInfo $webApp Description of the Web App that will be launched when the user presses the button. The Web App will be able to send an arbitrary message on behalf of the user using the method answerWebAppQuery.
     */
    public function __construct(
        public string $text,
        public WebAppInfo $webApp,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['text'],
            WebAppInfo::fromPayload($payload['web_app']),
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'text' => $this->text,
            'web_app' => $this->webApp,
        ]);
    }

    /**
     * Type of the button, must be web_app.
     */
    public function type(): string
    {
        return $this->type;
    }
}