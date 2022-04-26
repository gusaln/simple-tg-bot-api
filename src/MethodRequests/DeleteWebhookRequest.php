<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success.
 */
class DeleteWebhookRequest extends MethodRequest
{
    /**
     * @param bool|null $dropPendingUpdates Pass True to drop all pending updates
    */
    public function __construct(
        public ?bool $dropPendingUpdates = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['drop_pending_updates'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'drop_pending_updates' => $this->dropPendingUpdates,
        ]);
    }

    public function method(): string
    {
        return 'deleteWebhook';
    }
}