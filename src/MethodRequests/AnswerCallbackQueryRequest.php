<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, True is returned.
 */
class AnswerCallbackQueryRequest extends MethodRequest
{
    /**
     * @param string $callbackQueryId Unique identifier for the query to be answered
     * @param string|null $text Text of the notification. If not specified, nothing will be shown to the user, 0-200 characters
     * @param bool|null $showAlert If True, an alert will be shown by the client instead of a notification at the top of the chat screen. Defaults to false.
     * @param string|null $url URL that will be opened by the user's client. If you have created a Game and accepted the conditions via @Botfather, specify the URL that opens your game — note that this will only work if the query comes from a callback_game button.Otherwise, you may use links like t.me/your_bot?start=XXXX that open your bot with a parameter.
     * @param int|null $cacheTime The maximum amount of time in seconds that the result of the callback query may be cached client-side. Telegram apps will support caching starting in version 3.14. Defaults to 0.
    */
    public function __construct(
        public string $callbackQueryId,
        public ?string $text = null,
        public ?bool $showAlert = null,
        public ?string $url = null,
        public ?int $cacheTime = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['callback_query_id'],
            $payload['text'] ?? null,
            $payload['show_alert'] ?? null,
            $payload['url'] ?? null,
            $payload['cache_time'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'callback_query_id' => $this->callbackQueryId,
            'text' => $this->text,
            'show_alert' => $this->showAlert,
            'url' => $this->url,
            'cache_time' => $this->cacheTime,
        ]);
    }

    public function method(): string
    {
        return 'answerCallbackQuery';
    }
}