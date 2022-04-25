<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Webhooks;

use GusALN\TelegramBotApi\Types\Update;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;

/**
 * Fetches {@see \GusALN\TelegramBotApi\Types\Update} from requests.
 */
class WebhookUpdateFetcher
{
    public function fetch(RequestInterface|string $request): Update
    {
        $input = json_decode($this->getContents($request), associative: true);
        if (! is_array($input)) {
            throw new InvalidArgumentException('Request content must be valid JSON object.');
        }

        return Update::fromPayload($input);
    }

    private function getContents($request): string
    {
        if ($request instanceof RequestInterface) {
            return $request->getBody()->getContents();
        }
        if (is_string($request)) {
            return $request;
        }
        throw new InvalidArgumentException('Request must be instance of Psr\Http\Message\RequestInterface or string.');
    }
}
