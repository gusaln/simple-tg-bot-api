<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use JsonSerializable;

/**
 * Represents a Game.
 * Note: This will only work in Telegram versions released after October 1, 2016. Older clients will not display any inline results if a game result is among them.
 */
class InlineQueryResultGame extends InlineQueryResult implements JsonSerializable
{
    private string $type = 'game';

    /**
     * @param string $id Unique identifier for this result, 1-64 bytes
     * @param string $gameShortName Short name of the game
     * @param InlineKeyboardMarkup|null $replyMarkup Optional. Inline keyboard attached to the message
     */
    public function __construct(
        public string $id,
        public string $gameShortName,
        public ?InlineKeyboardMarkup $replyMarkup = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['id'],
            $payload['game_short_name'],
            isset($payload['reply_markup']) ? InlineKeyboardMarkup::fromPayload($payload['reply_markup']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'type' => $this->type,
            'id' => $this->id,
            'game_short_name' => $this->gameShortName,
            'reply_markup' => $this->replyMarkup,
        ]);
    }

    /**
     * Type of the result, must be game.
     */
    public function type(): string
    {
        return $this->type;
    }
}