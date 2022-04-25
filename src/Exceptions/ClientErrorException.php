<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Exceptions;

use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Exception when a client error is encountered (4xx codes).
 */
class ClientErrorException extends RuntimeException
{
    private RequestInterface $request;

    private ResponseInterface $response;

    public function __construct(ClientException $previous)
    {
        parent::__construct(
            message: 'There was an error in the sent request: '.$previous->getMessage(),
            previous: $previous
        );

        $this->request = $previous->getRequest();
        $this->response = $previous->getResponse();
    }

    public static function fromGuzzleException(ClientException $clientException)
    {
        return new self($clientException);
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
