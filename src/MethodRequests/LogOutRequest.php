<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to log out from the cloud Bot API server before launching the bot locally. You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes. Returns True on success. Requires no parameters.
 */
class LogOutRequest extends MethodRequest
{
    public function __construct()
    {
    }

    public static function fromPayload(array $payload): static
    {
        return new self();
    }


    public function jsonSerialize(): mixed
    {
        return [];
    }

    public function method(): string
    {
        return 'logOut';
    }
}