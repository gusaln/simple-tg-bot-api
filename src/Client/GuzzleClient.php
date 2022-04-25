<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Client;

use GusALN\TelegramBotApi\Contracts\ClientInterface;
use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Exceptions\ClientErrorException;
use GusALN\TelegramBotApi\Exceptions\ConnectionErrorException;
use GusALN\TelegramBotApi\Exceptions\RuntimeException;
use GusALN\TelegramBotApi\Exceptions\ServerErrorException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use Throwable;

class GuzzleClient implements ClientInterface
{
    private HttpClient $client;

    public function __construct(protected int|float|null $timeout = null)
    {
        $this->client = new HttpClient(['timeout' => $timeout]);
    }

    public function call(string $apiUrl, string $token, MethodRequest $apiRequest): Response
    {
        $url = rtrim($apiUrl, '/').'/bot'.$token.'/'.$apiRequest->method();

        try {
            $response = new Response($this->client->post($url, ['json' => $apiRequest]));
        } catch (ClientException $ex) {
            throw new ClientErrorException($ex);
        } catch (ServerException $ex) {
            throw new ServerErrorException($ex);
        } catch (ConnectException $ex) {
            throw new ConnectionErrorException($ex);
        } catch (Throwable $ex) {
            throw new RuntimeException("Error trying to process request: {$ex->getMessage()}", previous: $ex);
        }

        return $response;
    }
}
