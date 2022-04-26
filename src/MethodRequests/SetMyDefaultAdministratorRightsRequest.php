<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\ChatAdministratorRights;

/**
 * Use this method to change the default administrator rights requested by the bot when it's added as an administrator to groups or channels. These rights will be suggested to users, but they are are free to modify the list before adding the bot. Returns True on success.
 */
class SetMyDefaultAdministratorRightsRequest extends MethodRequest
{
    /**
     * @param ChatAdministratorRights|null $rights A JSON-serialized object describing new default administrator rights. If not specified, the default administrator rights will be cleared.
     * @param bool|null $forChannels Pass True to change the default administrator rights of the bot in channels. Otherwise, the default administrator rights of the bot for groups and supergroups will be changed.
    */
    public function __construct(
        public ?ChatAdministratorRights $rights = null,
        public ?bool $forChannels = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            isset($payload['rights']) ? ChatAdministratorRights::fromPayload($payload['rights']) : null,
            $payload['for_channels'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'rights' => $this->rights,
            'for_channels' => $this->forChannels,
        ]);
    }

    public function method(): string
    {
        return 'setMyDefaultAdministratorRights';
    }
}