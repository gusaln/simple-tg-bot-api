<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a chat photo.
 */
class ChatPhoto implements JsonSerializable
{
    /**
     * @param string $smallFileId File identifier of small (160x160) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
     * @param string $smallFileUniqueId Unique file identifier of small (160x160) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @param string $bigFileId File identifier of big (640x640) chat photo. This file_id can be used only for photo download and only for as long as the photo is not changed.
     * @param string $bigFileUniqueId Unique file identifier of big (640x640) chat photo, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     */
    public function __construct(
        public string $smallFileId,
        public string $smallFileUniqueId,
        public string $bigFileId,
        public string $bigFileUniqueId,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['small_file_id'],
            $payload['small_file_unique_id'],
            $payload['big_file_id'],
            $payload['big_file_unique_id'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'small_file_id' => $this->smallFileId,
            'small_file_unique_id' => $this->smallFileUniqueId,
            'big_file_id' => $this->bigFileId,
            'big_file_unique_id' => $this->bigFileUniqueId,
        ]);
    }
}