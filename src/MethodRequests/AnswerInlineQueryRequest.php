<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InlineQueryResult;

/**
 * Use this method to send answers to an inline query. On success, True is returned.No more than 50 results per query are allowed.
 */
class AnswerInlineQueryRequest extends MethodRequest
{
    /**
     * @param string $inlineQueryId Unique identifier for the answered query
     * @param InlineQueryResult[] $results A JSON-serialized array of results for the inline query
     * @param int|null $cacheTime The maximum amount of time in seconds that the result of the inline query may be cached on the server. Defaults to 300.
     * @param bool|null $isPersonal Pass True, if results may be cached on the server side only for the user that sent the query. By default, results may be returned to any user who sends the same query
     * @param string|null $nextOffset Pass the offset that a client should send in the next query with the same text to receive more results. Pass an empty string if there are no more results or if you don't support pagination. Offset length can't exceed 64 bytes.
     * @param string|null $switchPmText If passed, clients will display a button with specified text that switches the user to a private chat with the bot and sends the bot a start message with the parameter switch_pm_parameter
     * @param string|null $switchPmParameter Deep-linking parameter for the /start message sent to the bot when user presses the switch button. 1-64 characters, only A-Z, a-z, 0-9, _ and - are allowed.Example: An inline bot that sends YouTube videos can ask the user to connect the bot to their YouTube account to adapt search results accordingly. To do this, it displays a 'Connect your YouTube account' button above the results, or even before showing any. The user presses the button, switches to a private chat with the bot and, in doing so, passes a start parameter that instructs the bot to return an OAuth link. Once done, the bot can offer a switch_inline button so that the user can easily return to the chat where they wanted to use the bot's inline capabilities.
    */
    public function __construct(
        public string $inlineQueryId,
        public array $results,
        public ?int $cacheTime = null,
        public ?bool $isPersonal = null,
        public ?string $nextOffset = null,
        public ?string $switchPmText = null,
        public ?string $switchPmParameter = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['inline_query_id'],
            array_map(fn($t) => InlineQueryResult::fromPayload($t), $payload['results']),
            $payload['cache_time'] ?? null,
            $payload['is_personal'] ?? null,
            $payload['next_offset'] ?? null,
            $payload['switch_pm_text'] ?? null,
            $payload['switch_pm_parameter'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'inline_query_id' => $this->inlineQueryId,
            'results' => $this->results,
            'cache_time' => $this->cacheTime,
            'is_personal' => $this->isPersonal,
            'next_offset' => $this->nextOffset,
            'switch_pm_text' => $this->switchPmText,
            'switch_pm_parameter' => $this->switchPmParameter,
        ]);
    }

    public function method(): string
    {
        return 'answerInlineQuery';
    }
}