<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InlineQueryResult;

/**
 * Use this method to set the result of an interaction with a Web App and send a corresponding message on behalf of the user to the chat from which the query originated. On success, a SentWebAppMessage object is returned.
 */
class AnswerWebAppQueryRequest extends MethodRequest
{
    /**
     * @param string $webAppQueryId Unique identifier for the query to be answered
     * @param InlineQueryResult $result A JSON-serialized object describing the message to be sent
    */
    public function __construct(
        public string $webAppQueryId,
        public InlineQueryResult $result,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['web_app_query_id'],
            $payload['result'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'web_app_query_id' => $this->webAppQueryId,
            'result' => $this->result,
        ]);
    }

    public function method(): string
    {
        return 'answerWebAppQuery';
    }
}