<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * This object represents one row of the high scores table for a game.
 * And that's about all we've got for now.If you've got any questions, please check out our Bot FAQ »
 */
class GameHighScore implements JsonSerializable
{
    /**
     * @param int $position Position in high score table for the game
     * @param User $user User
     * @param int $score Score
     */
    public function __construct(
        public int $position,
        public User $user,
        public int $score,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['position'],
            User::fromPayload($payload['user']),
            $payload['score'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'position' => $this->position,
            'user' => $this->user,
            'score' => $this->score,
        ]);
    }
}