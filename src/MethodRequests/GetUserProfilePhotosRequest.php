<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
 */
class GetUserProfilePhotosRequest extends MethodRequest
{
    /**
     * @param int $userId Unique identifier of the target user
     * @param int|null $offset Sequential number of the first photo to be returned. By default, all photos are returned.
     * @param int|null $limit Limits the number of photos to be retrieved. Values between 1-100 are accepted. Defaults to 100.
    */
    public function __construct(
        public int $userId,
        public ?int $offset = null,
        public ?int $limit = null,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['user_id'],
            $payload['offset'],
            $payload['limit'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'user_id' => $this->userId,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ]);
    }

    public function method(): string
    {
        return 'getUserProfilePhotos';
    }
}