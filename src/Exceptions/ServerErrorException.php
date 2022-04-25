<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Exceptions;

use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Exception when a server error is encountered (5xx codes).
 */
class ServerErrorException extends RuntimeException
{
    private RequestInterface $request;
    private ResponseInterface $response;

    public function __construct(ServerException $previous)
    {
        parent::__construct(
            message: 'There was an error while trying to process the request: '.$previous->getMessage(),
            previous: $previous
        );

        $this->request = $previous->getRequest();
        $this->response = $previous->getResponse();
    }

    public static function fromGuzzleException(ServerException $serverException)
    {
        return new self($serverException);
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
