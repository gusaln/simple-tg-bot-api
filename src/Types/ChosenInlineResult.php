<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\Location;
use GusALN\TelegramBotApi\Types\User;
use JsonSerializable;

/**
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner.
 * Note: It is necessary to enable inline feedback via @Botfather in order to receive these objects in updates.
 */
class ChosenInlineResult implements JsonSerializable
{
    /**
     * @param string $resultId The unique identifier for the result that was chosen
     * @param User $from The user that chose the result
     * @param Location|null $location Optional. Sender location, only for bots that require user location
     * @param string|null $inlineMessageId Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
     * @param string $query The query that was used to obtain the result
     */
    public function __construct(
        public string $resultId,
        public User $from,
        public ?Location $location = null,
        public ?string $inlineMessageId = null,
        public string $query,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['result_id'],
            User::fromPayload($payload['from']),
            isset($payload['location']) ? Location::fromPayload($payload['location']) : null,
            $payload['inline_message_id'] ?? null,
            $payload['query'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'result_id' => $this->resultId,
            'from' => $this->from,
            'location' => $this->location,
            'inline_message_id' => $this->inlineMessageId,
            'query' => $this->query,
        ]);
    }
}