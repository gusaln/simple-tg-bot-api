<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi;

use GusALN\TelegramBotApi\Client\GuzzleClient;
use GusALN\TelegramBotApi\Client\Response;
use GusALN\TelegramBotApi\Contracts\ClientInterface;
use GusALN\TelegramBotApi\Contracts\MethodRequest;

abstract class BaseBotApi
{
    protected ClientInterface $client;

    public function __construct(
        protected string $token,
        protected string $apiUrl = 'https://api.telegram.org/',
        ClientInterface $client = null
    ) {
        $this->client = $client ?? new GuzzleClient();
    }

    public function call(MethodRequest $apiRequest): Response
    {
        return $this->client->call($this->apiUrl, $this->token, $apiRequest);
    }
}
