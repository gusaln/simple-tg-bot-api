<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\MethodRequests;

use GusALN\TelegramBotApi\Contracts\MethodRequest;

/**
 * Use this method to revoke an invite link created by the bot. If the primary link is revoked, a new link is automatically generated. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the revoked invite link as ChatInviteLink object.
 */
class RevokeChatInviteLinkRequest extends MethodRequest
{
    /**
     * @param int|string $chatId Unique identifier of the target chat or username of the target channel (in the format @channelusername)
     * @param string $inviteLink The invite link to revoke
    */
    public function __construct(
        public int|string $chatId,
        public string $inviteLink,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['chat_id'],
            $payload['invite_link'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'chat_id' => $this->chatId,
            'invite_link' => $this->inviteLink,
        ]);
    }

    public function method(): string
    {
        return 'revokeChatInviteLink';
    }
}