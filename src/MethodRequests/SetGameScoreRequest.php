<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to set the score of the specified user in a game message. On success, if the message is not an inline message, the Message is returned, otherwise True is returned. Returns an error, if the new score is not greater than the user's current score in the chat and force is False.
 */
class SetGameScoreRequest extends MethodRequest
{
    /**
     * @param int $userId User identifier
     * @param int $score New score, must be non-negative
     * @param bool|null $force Pass True, if the high score is allowed to decrease. This can be useful when fixing mistakes or banning cheaters
     * @param bool|null $disableEditMessage Pass True, if the game message should not be automatically edited to include the current scoreboard
     * @param int|null $chatId Required if inline_message_id is not specified. Unique identifier for the target chat
     * @param int|null $messageId Required if inline_message_id is not specified. Identifier of the sent message
     * @param string|null $inlineMessageId Required if chat_id and message_id are not specified. Identifier of the inline message
    */
    public function __construct(
        public int $userId,
        public int $score,
        public ?bool $force = null,
        public ?bool $disableEditMessage = null,
        public ?int $chatId = null,
        public ?int $messageId = null,
        public ?string $inlineMessageId = null,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['user_id'],
            $payload['score'],
            $payload['force'],
            $payload['disable_edit_message'],
            $payload['chat_id'],
            $payload['message_id'],
            $payload['inline_message_id'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'user_id' => $this->userId,
            'score' => $this->score,
            'force' => $this->force,
            'disable_edit_message' => $this->disableEditMessage,
            'chat_id' => $this->chatId,
            'message_id' => $this->messageId,
            'inline_message_id' => $this->inlineMessageId,
        ]);
    }

    public function method(): string
    {
        return 'setGameScore';
    }
}