<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object contains information about one answer option in a poll.
 */
class PollOption implements JsonSerializable
{
    /**
     * @param string $text Option text, 1-100 characters
     * @param int $voterCount Number of users that voted for this option
     */
    public function __construct(
        public string $text,
        public int $voterCount,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['text'],
            $payload['voter_count'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'text' => $this->text,
            'voter_count' => $this->voterCount,
        ]);
    }
}