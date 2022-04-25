<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Client;

use GusALN\TelegramBotApi\Contracts\ClientInterface;
use GusALN\TelegramBotApi\Contracts\MethodRequest;

class EchoClient implements ClientInterface
{
    public function __construct(private ClientInterface $client)
    {
    }

    public function call(string $apiUrl, string $token, MethodRequest $apiRequest): Response
    {
        echo json_encode(compact('apiUrl', 'token', 'apiRequest')).PHP_EOL;
        $response = $this->client->call($apiUrl, $token, $apiRequest);
        echo json_encode(compact('response')).PHP_EOL;

        return $response;
    }
}
