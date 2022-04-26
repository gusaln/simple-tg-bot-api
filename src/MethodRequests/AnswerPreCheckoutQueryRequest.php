<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query. Use this method to respond to such pre-checkout queries. On success, True is returned. Note: The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
 */
class AnswerPreCheckoutQueryRequest extends MethodRequest
{
    /**
     * @param string $preCheckoutQueryId Unique identifier for the query to be answered
     * @param bool $ok Specify True if everything is alright (goods are available, etc.) and the bot is ready to proceed with the order. Use False if there are any problems.
     * @param string|null $errorMessage Required if ok is False. Error message in human readable form that explains the reason for failure to proceed with the checkout (e.g. "Sorry, somebody just bought the last of our amazing black T-shirts while you were busy filling out your payment details. Please choose a different color or garment!"). Telegram will display this message to the user.
    */
    public function __construct(
        public string $preCheckoutQueryId,
        public bool $ok,
        public ?string $errorMessage = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['pre_checkout_query_id'],
            $payload['ok'],
            $payload['error_message'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'pre_checkout_query_id' => $this->preCheckoutQueryId,
            'ok' => $this->ok,
            'error_message' => $this->errorMessage,
        ]);
    }

    public function method(): string
    {
        return 'answerPreCheckoutQuery';
    }
}