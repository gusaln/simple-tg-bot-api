<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use JsonSerializable;

/**
 * Contains information about the current status of a webhook.
 */
class WebhookInfo implements JsonSerializable
{
    /**
     * @param string $url Webhook URL, may be empty if webhook is not set up
     * @param bool $hasCustomCertificate True, if a custom certificate was provided for webhook certificate checks
     * @param int $pendingUpdateCount Number of updates awaiting delivery
     * @param string|null $ipAddress Optional. Currently used webhook IP address
     * @param int|null $lastErrorDate Optional. Unix time for the most recent error that happened when trying to deliver an update via webhook
     * @param string|null $lastErrorMessage Optional. Error message in human-readable format for the most recent error that happened when trying to deliver an update via webhook
     * @param int|null $lastSynchronizationErrorDate Optional. Unix time of the most recent error that happened when trying to synchronize available updates with Telegram datacenters
     * @param int|null $maxConnections Optional. Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery
     * @param string[]|null $allowedUpdates Optional. A list of update types the bot is subscribed to. Defaults to all update types except chat_member
     */
    public function __construct(
        public string $url,
        public bool $hasCustomCertificate,
        public int $pendingUpdateCount,
        public ?string $ipAddress = null,
        public ?int $lastErrorDate = null,
        public ?string $lastErrorMessage = null,
        public ?int $lastSynchronizationErrorDate = null,
        public ?int $maxConnections = null,
        public ?array $allowedUpdates = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['url'],
            $payload['has_custom_certificate'],
            $payload['pending_update_count'],
            $payload['ip_address'] ?? null,
            $payload['last_error_date'] ?? null,
            $payload['last_error_message'] ?? null,
            $payload['last_synchronization_error_date'] ?? null,
            $payload['max_connections'] ?? null,
            $payload['allowed_updates'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'url' => $this->url,
            'has_custom_certificate' => $this->hasCustomCertificate,
            'pending_update_count' => $this->pendingUpdateCount,
            'ip_address' => $this->ipAddress,
            'last_error_date' => $this->lastErrorDate,
            'last_error_message' => $this->lastErrorMessage,
            'last_synchronization_error_date' => $this->lastSynchronizationErrorDate,
            'max_connections' => $this->maxConnections,
            'allowed_updates' => $this->allowedUpdates,
        ]);
    }
}