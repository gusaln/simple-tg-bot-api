<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Contracts;

use GusALN\TelegramBotApi\Exceptions\ClientErrorException;
use GusALN\TelegramBotApi\Exceptions\ConnectionErrorException;
use GusALN\TelegramBotApi\Exceptions\ServerErrorException;
use RuntimeException;

interface ClientInterface
{
    /**
     * Calls the API with a request.
     *
     * @throws ClientErrorException     Thrown when there is an error in the request
     * @throws ServerErrorException     Thrown when the server had an internal error
     * @throws ConnectionErrorException Thrown when there was a problem while establishing the connection to the server
     * @throws RuntimeException         Thrown when another type of error found
     */
    public function call(string $apiUrl, string $token, MethodRequest $apiRequest): mixed;
}
