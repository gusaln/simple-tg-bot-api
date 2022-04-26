<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned.
 */
class GetUpdatesRequest extends MethodRequest
{
    /**
     * @param int|null $offset Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id. The negative offset can be specified to retrieve updates starting from -offset update from the end of the updates queue. All previous updates will forgotten.
     * @param int|null $limit Limits the number of updates to be retrieved. Values between 1-100 are accepted. Defaults to 100.
     * @param int|null $timeout Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling. Should be positive, short polling should be used for testing purposes only.
     * @param string[]|null $allowedUpdates A JSON-serialized list of the update types you want your bot to receive. For example, specify ["message", "edited_channel_post", "callback_query"] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all update types except chat_member (default). If not specified, the previous setting will be used.Please note that this parameter doesn't affect updates created before the call to the getUpdates, so unwanted updates may be received for a short period of time.
    */
    public function __construct(
        public ?int $offset = null,
        public ?int $limit = null,
        public ?int $timeout = null,
        public ?array $allowedUpdates = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['offset'] ?? null,
            $payload['limit'] ?? null,
            $payload['timeout'] ?? null,
            $payload['allowed_updates'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'offset' => $this->offset,
            'limit' => $this->limit,
            'timeout' => $this->timeout,
            'allowed_updates' => $this->allowedUpdates,
        ]);
    }

    public function method(): string
    {
        return 'getUpdates';
    }
}