<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represent a user's profile pictures.
 */
class UserProfilePhotos implements JsonSerializable
{
    /**
     * @param int $totalCount Total number of profile pictures the target user has
     * @param array[] $photos Requested profile pictures (in up to 4 sizes each)
     */
    public function __construct(
        public int $totalCount,
        public array $photos,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['total_count'],
            $payload['photos'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'total_count' => $this->totalCount,
            'photos' => $this->photos,
        ]);
    }
}