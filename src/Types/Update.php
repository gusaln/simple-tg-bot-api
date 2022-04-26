<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\CallbackQuery;
use GusALN\TelegramBotApi\Types\ChatJoinRequest;
use GusALN\TelegramBotApi\Types\ChatMemberUpdated;
use GusALN\TelegramBotApi\Types\ChosenInlineResult;
use GusALN\TelegramBotApi\Types\InlineQuery;
use GusALN\TelegramBotApi\Types\Message;
use GusALN\TelegramBotApi\Types\Poll;
use GusALN\TelegramBotApi\Types\PollAnswer;
use GusALN\TelegramBotApi\Types\PreCheckoutQuery;
use GusALN\TelegramBotApi\Types\ShippingQuery;
use JsonSerializable;

/**
 * This object represents an incoming update.At most one of the optional parameters can be present in any given update.
 */
class Update implements JsonSerializable
{
    /**
     * @param int $updateId The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you're using Webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
     * @param Message|null $message Optional. New incoming message of any kind — text, photo, sticker, etc.
     * @param Message|null $editedMessage Optional. New version of a message that is known to the bot and was edited
     * @param Message|null $channelPost Optional. New incoming channel post of any kind — text, photo, sticker, etc.
     * @param Message|null $editedChannelPost Optional. New version of a channel post that is known to the bot and was edited
     * @param InlineQuery|null $inlineQuery Optional. New incoming inline query
     * @param ChosenInlineResult|null $chosenInlineResult Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
     * @param CallbackQuery|null $callbackQuery Optional. New incoming callback query
     * @param ShippingQuery|null $shippingQuery Optional. New incoming shipping query. Only for invoices with flexible price
     * @param PreCheckoutQuery|null $preCheckoutQuery Optional. New incoming pre-checkout query. Contains full information about checkout
     * @param Poll|null $poll Optional. New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot
     * @param PollAnswer|null $pollAnswer Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
     * @param ChatMemberUpdated|null $myChatMember Optional. The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
     * @param ChatMemberUpdated|null $chatMember Optional. A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify "chat_member" in the list of allowed_updates to receive these updates.
     * @param ChatJoinRequest|null $chatJoinRequest Optional. A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates.
     */
    public function __construct(
        public int $updateId,
        public ?Message $message = null,
        public ?Message $editedMessage = null,
        public ?Message $channelPost = null,
        public ?Message $editedChannelPost = null,
        public ?InlineQuery $inlineQuery = null,
        public ?ChosenInlineResult $chosenInlineResult = null,
        public ?CallbackQuery $callbackQuery = null,
        public ?ShippingQuery $shippingQuery = null,
        public ?PreCheckoutQuery $preCheckoutQuery = null,
        public ?Poll $poll = null,
        public ?PollAnswer $pollAnswer = null,
        public ?ChatMemberUpdated $myChatMember = null,
        public ?ChatMemberUpdated $chatMember = null,
        public ?ChatJoinRequest $chatJoinRequest = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['update_id'],
            isset($payload['message']) ? Message::fromPayload($payload['message']) : null,
            isset($payload['edited_message']) ? Message::fromPayload($payload['edited_message']) : null,
            isset($payload['channel_post']) ? Message::fromPayload($payload['channel_post']) : null,
            isset($payload['edited_channel_post']) ? Message::fromPayload($payload['edited_channel_post']) : null,
            isset($payload['inline_query']) ? InlineQuery::fromPayload($payload['inline_query']) : null,
            isset($payload['chosen_inline_result']) ? ChosenInlineResult::fromPayload($payload['chosen_inline_result']) : null,
            isset($payload['callback_query']) ? CallbackQuery::fromPayload($payload['callback_query']) : null,
            isset($payload['shipping_query']) ? ShippingQuery::fromPayload($payload['shipping_query']) : null,
            isset($payload['pre_checkout_query']) ? PreCheckoutQuery::fromPayload($payload['pre_checkout_query']) : null,
            isset($payload['poll']) ? Poll::fromPayload($payload['poll']) : null,
            isset($payload['poll_answer']) ? PollAnswer::fromPayload($payload['poll_answer']) : null,
            isset($payload['my_chat_member']) ? ChatMemberUpdated::fromPayload($payload['my_chat_member']) : null,
            isset($payload['chat_member']) ? ChatMemberUpdated::fromPayload($payload['chat_member']) : null,
            isset($payload['chat_join_request']) ? ChatJoinRequest::fromPayload($payload['chat_join_request']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'update_id' => $this->updateId,
            'message' => $this->message,
            'edited_message' => $this->editedMessage,
            'channel_post' => $this->channelPost,
            'edited_channel_post' => $this->editedChannelPost,
            'inline_query' => $this->inlineQuery,
            'chosen_inline_result' => $this->chosenInlineResult,
            'callback_query' => $this->callbackQuery,
            'shipping_query' => $this->shippingQuery,
            'pre_checkout_query' => $this->preCheckoutQuery,
            'poll' => $this->poll,
            'poll_answer' => $this->pollAnswer,
            'my_chat_member' => $this->myChatMember,
            'chat_member' => $this->chatMember,
            'chat_join_request' => $this->chatJoinRequest,
        ]);
    }
}