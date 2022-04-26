<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Contains information about a Web App.
 */
class WebAppInfo implements JsonSerializable
{
    /**
     * @param string $url An HTTPS URL of a Web App to be opened with additional data as specified in Initializing Web Apps
     */
    public function __construct(
        public string $url,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['url'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'url' => $this->url,
        ]);
    }
}