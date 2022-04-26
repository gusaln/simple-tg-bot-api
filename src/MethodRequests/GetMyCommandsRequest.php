<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\BotCommandScope;

/**
 * Use this method to get the current list of the bot's commands for the given scope and user language. Returns Array of BotCommand on success. If commands aren't set, an empty list is returned.
 */
class GetMyCommandsRequest extends MethodRequest
{
    /**
     * @param BotCommandScope|null $scope A JSON-serialized object, describing scope of users. Defaults to BotCommandScopeDefault.
     * @param string|null $languageCode A two-letter ISO 639-1 language code or an empty string
    */
    public function __construct(
        public ?BotCommandScope $scope = null,
        public ?string $languageCode = null,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['scope'],
            $payload['language_code'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'scope' => $this->scope,
            'language_code' => $this->languageCode,
        ]);
    }

    public function method(): string
    {
        return 'getMyCommands';
    }
}