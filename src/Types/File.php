<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * This object represents a file ready to be downloaded. The file can be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile.
 */
class File implements JsonSerializable
{
    /**
     * @param string $fileId Identifier for this file, which can be used to download or reuse the file
     * @param string $fileUniqueId Unique identifier for this file, which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     * @param int|null $fileSize Optional. File size in bytes, if known
     * @param string|null $filePath Optional. File path. Use https://api.telegram.org/file/bot<token>/<file_path> to get the file.
     */
    public function __construct(
        public string $fileId,
        public string $fileUniqueId,
        public ?int $fileSize = null,
        public ?string $filePath = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['file_id'],
            $payload['file_unique_id'],
            $payload['file_size'] ?? null,
            $payload['file_path'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'file_id' => $this->fileId,
            'file_unique_id' => $this->fileUniqueId,
            'file_size' => $this->fileSize,
            'file_path' => $this->filePath,
        ]);
    }
}