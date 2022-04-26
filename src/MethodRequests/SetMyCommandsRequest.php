<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\BotCommand;
use GusALN\TelegramBotApi\Types\BotCommandScope;

/**
 * Use this method to change the list of the bot's commands. See https://core.telegram.org/bots#commands for more details about bot commands. Returns True on success.
 */
class SetMyCommandsRequest extends MethodRequest
{
    /**
     * @param BotCommand[] $commands A JSON-serialized list of bot commands to be set as the list of the bot's commands. At most 100 commands can be specified.
     * @param BotCommandScope|null $scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
     * @param string|null $languageCode A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
    */
    public function __construct(
        public array $commands,
        public ?BotCommandScope $scope = null,
        public ?string $languageCode = null,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['commands'],
            $payload['scope'],
            $payload['language_code'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'commands' => $this->commands,
            'scope' => $this->scope,
            'language_code' => $this->languageCode,
        ]);
    }

    public function method(): string
    {
        return 'setMyCommands';
    }
}