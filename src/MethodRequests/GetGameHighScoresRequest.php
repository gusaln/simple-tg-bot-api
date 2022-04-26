<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to get data for high score tables. Will return the score of the specified user and several of their neighbors in a game. On success, returns an Array of GameHighScore objects.
 */
class GetGameHighScoresRequest extends MethodRequest
{
    /**
     * @param int $userId Target user id
     * @param int|null $chatId Required if inline_message_id is not specified. Unique identifier for the target chat
     * @param int|null $messageId Required if inline_message_id is not specified. Identifier of the sent message
     * @param string|null $inlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
    */
    public function __construct(
        public int $userId,
        public ?int $chatId = null,
        public ?int $messageId = null,
        public ?string $inlineMessageId = null,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['user_id'],
            $payload['chat_id'],
            $payload['message_id'],
            $payload['inline_message_id'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'user_id' => $this->userId,
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
            'inline_message_id' => $this->inlineMessageId,
        ]);
    }

    public function method(): string
    {
        return 'getGameHighScores';
    }
}