<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to get the current default administrator rights of the bot. Returns ChatAdministratorRights on success.
 */
class GetMyDefaultAdministratorRightsRequest extends MethodRequest
{
    /**
     * @param bool|null $forChannels Pass True to get default administrator rights of the bot in channels. Otherwise, default administrator rights of the bot for groups and supergroups will be returned.
    */
    public function __construct(
        public ?bool $forChannels = null,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['for_channels'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'for_channels' => $this->forChannels,
        ]);
    }

    public function method(): string
    {
        return 'getMyDefaultAdministratorRights';
    }
}