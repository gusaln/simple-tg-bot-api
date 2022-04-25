<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Client;

use JsonSerializable;
use Psr\Http\Message\ResponseInterface;

class Response implements JsonSerializable
{
    protected bool $ok;
    protected array|string|int|bool|null $result;

    public function __construct(protected ResponseInterface $httpResponse)
    {
        $content = json_decode($httpResponse->getBody()->getContents(), true);

        $this->ok = $content['ok'] ?? false;
        $this->result = $content['result'] ?? null;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'ok' => $this->isOk(),
            'result' => $this->getPayload(),
        ];
    }

    /**
     * Indicates if the request was successful.
     */
    public function isOk(): bool
    {
        return $this->ok;
    }

    /**
     * The payload from the response.
     *
     * @return array|string|int|bool|null
     */
    public function getPayload()
    {
        return $this->result;
    }
}
