<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;
use GusALN\TelegramBotApi\Types\InputFile;

/**
 * Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns True on success.
 * If you'd like to make sure that the Webhook request comes from Telegram, we recommend using a secret path in the URL, e.g. https://www.example.com/<token>. Since nobody else knows your bot's token, you can be pretty sure it's us.
 */
class SetWebhookRequest extends MethodRequest
{
    /**
     * @param string $url HTTPS url to send updates to. Use an empty string to remove webhook integration
     * @param InputFile|null $certificate Upload your public key certificate so that the root certificate in use can be checked. See our self-signed guide for details.
     * @param string|null $ipAddress The fixed IP address which will be used to send webhook requests instead of the IP address resolved through DNS
     * @param int|null $maxConnections Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to 40. Use lower values to limit the load on your bot's server, and higher values to increase your bot's throughput.
     * @param string[]|null $allowedUpdates A JSON-serialized list of the update types you want your bot to receive. For example, specify ["message", "edited_channel_post", "callback_query"] to only receive updates of these types. See Update for a complete list of available update types. Specify an empty list to receive all update types except chat_member (default). If not specified, the previous setting will be used.Please note that this parameter doesn't affect updates created before the call to the setWebhook, so unwanted updates may be received for a short period of time.
     * @param bool|null $dropPendingUpdates Pass True to drop all pending updates
    */
    public function __construct(
        public string $url,
        public ?InputFile $certificate = null,
        public ?string $ipAddress = null,
        public ?int $maxConnections = null,
        public ?array $allowedUpdates = null,
        public ?bool $dropPendingUpdates = null,
    ) {
    }

    public static function fromPayload(array $payload): static
    {
        return new self(
            $payload['url'],
            $payload['certificate'],
            $payload['ip_address'],
            $payload['max_connections'],
            $payload['allowed_updates'],
            $payload['drop_pending_updates'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'url' => $this->url,
            'certificate' => $this->certificate,
            'ip_address' => $this->ipAddress,
            'max_connections' => $this->maxConnections,
            'allowed_updates' => $this->allowedUpdates,
            'drop_pending_updates' => $this->dropPendingUpdates,
        ]);
    }

    public function method(): string
    {
        return 'setWebhook';
    }
}