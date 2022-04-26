<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\BotCommandScope;

/**
 * Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users. Returns True on success.
 */
class DeleteMyCommandsRequest extends MethodRequest
{
    /**
     * @param BotCommandScope|null $scope A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
     * @param string|null $languageCode A two-letter ISO 639-1 language code. If empty, commands will be applied to all users from the given scope, for whose language there are no dedicated commands
    */
    public function __construct(
        public ?BotCommandScope $scope = null,
        public ?string $languageCode = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            isset($payload['scope']) ? BotCommandScope::fromPayload($payload['scope']) : null,
            $payload['language_code'] ?? null,
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
        return 'deleteMyCommands';
    }
}