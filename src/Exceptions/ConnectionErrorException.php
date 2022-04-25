<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Exceptions;

use GuzzleHttp\Exception\ConnectException;
use Psr\Http\Message\RequestInterface;

/**
 * Exception thrown when a connection cannot be established.
 */
class ConnectionErrorException extends RuntimeException
{
    private RequestInterface $request;

    public function __construct(ConnectException $previous)
    {
        parent::__construct(
            message: 'There was an error while trying to connect to the server: '.$previous->getMessage(),
            previous: $previous
        );

        $this->request = $previous->getRequest();
    }

    public static function fromGuzzleException(ConnectException $ex)
    {
        return new self($ex);
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
