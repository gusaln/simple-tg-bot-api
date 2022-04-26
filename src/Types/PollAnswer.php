<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * This object represents an answer of a user in a non-anonymous poll.
 */
class PollAnswer implements JsonSerializable
{
    /**
     * @param string $pollId Unique poll identifier
     * @param User $user The user, who changed the answer to the poll
     * @param int[] $optionIds 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote.
     */
    public function __construct(
        public string $pollId,
        public User $user,
        public array $optionIds,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['poll_id'],
            User::fromPayload($payload['user']),
            $payload['option_ids'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'poll_id' => $this->pollId,
            'user' => $this->user,
            'option_ids' => $this->optionIds,
        ]);
    }
}