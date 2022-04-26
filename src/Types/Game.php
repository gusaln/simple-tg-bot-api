<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\Animation;
use GusALN\TelegramBotApi\Types\MessageEntity;
use GusALN\TelegramBotApi\Types\PhotoSize;
use JsonSerializable;

/**
 * This object represents a game. Use BotFather to create and edit games, their short names will act as unique identifiers.
 */
class Game implements JsonSerializable
{
    /**
     * @param string $title Title of the game
     * @param string $description Description of the game
     * @param PhotoSize[] $photo Photo that will be displayed in the game message in chats.
     * @param string|null $text Optional. Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters.
     * @param MessageEntity[]|null $textEntities Optional. Special entities that appear in text, such as usernames, URLs, bot commands, etc.
     * @param Animation|null $animation Optional. Animation that will be displayed in the game message in chats. Upload via BotFather
     */
    public function __construct(
        public string $title,
        public string $description,
        public array $photo,
        public ?string $text = null,
        public ?array $textEntities = null,
        public ?Animation $animation = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['title'],
            $payload['description'],
            array_map(fn($t) => PhotoSize::fromPayload($t), $payload['photo']),
            $payload['text'] ?? null,
            isset($payload['text_entities']) ? array_map(fn($t) => MessageEntity::fromPayload($t), $payload['text_entities']) : null,
            isset($payload['animation']) ? Animation::fromPayload($payload['animation']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'title' => $this->title,
            'description' => $this->description,
            'photo' => $this->photo,
            'text' => $this->text,
            'text_entities' => $this->textEntities,
            'animation' => $this->animation,
        ]);
    }
}