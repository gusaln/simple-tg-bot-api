<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\Animation;
use GusALN\TelegramBotApi\Types\Audio;
use GusALN\TelegramBotApi\Types\Chat;
use GusALN\TelegramBotApi\Types\Contact;
use GusALN\TelegramBotApi\Types\Dice;
use GusALN\TelegramBotApi\Types\Document;
use GusALN\TelegramBotApi\Types\Game;
use GusALN\TelegramBotApi\Types\InlineKeyboardMarkup;
use GusALN\TelegramBotApi\Types\Invoice;
use GusALN\TelegramBotApi\Types\Location;
use GusALN\TelegramBotApi\Types\MessageAutoDeleteTimerChanged;
use GusALN\TelegramBotApi\Types\MessageEntity;
use GusALN\TelegramBotApi\Types\PassportData;
use GusALN\TelegramBotApi\Types\PhotoSize;
use GusALN\TelegramBotApi\Types\Poll;
use GusALN\TelegramBotApi\Types\ProximityAlertTriggered;
use GusALN\TelegramBotApi\Types\Sticker;
use GusALN\TelegramBotApi\Types\SuccessfulPayment;
use GusALN\TelegramBotApi\Types\User;
use GusALN\TelegramBotApi\Types\Venue;
use GusALN\TelegramBotApi\Types\Video;
use GusALN\TelegramBotApi\Types\VideoChatEnded;
use GusALN\TelegramBotApi\Types\VideoChatParticipantsInvited;
use GusALN\TelegramBotApi\Types\VideoChatScheduled;
use GusALN\TelegramBotApi\Types\VideoChatStarted;
use GusALN\TelegramBotApi\Types\VideoNote;
use GusALN\TelegramBotApi\Types\Voice;
use GusALN\TelegramBotApi\Types\WebAppData;
use JsonSerializable;

/**
 * This object represents a message.
 */
class Message implements JsonSerializable
{
    /**
     * @param int $messageId Unique message identifier inside this chat
     * @param User|null $from Optional. Sender of the message; empty for messages sent to channels. For backward compatibility, the field contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
     * @param Chat|null $senderChat Optional. Sender of the message, sent on behalf of a chat. For example, the channel itself for channel posts, the supergroup itself for messages from anonymous group administrators, the linked channel for messages automatically forwarded to the discussion group.  For backward compatibility, the field from contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
     * @param int $date Date the message was sent in Unix time
     * @param Chat $chat Conversation the message belongs to
     * @param User|null $forwardFrom Optional. For forwarded messages, sender of the original message
     * @param Chat|null $forwardFromChat Optional. For messages forwarded from channels or from anonymous administrators, information about the original sender chat
     * @param int|null $forwardFromMessageId Optional. For messages forwarded from channels, identifier of the original message in the channel
     * @param string|null $forwardSignature Optional. For forwarded messages that were originally sent in channels or by an anonymous chat administrator, signature of the message sender if present
     * @param string|null $forwardSenderName Optional. Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages
     * @param int|null $forwardDate Optional. For forwarded messages, date the original message was sent in Unix time
     * @param bool|null $isAutomaticForward Optional. True, if the message is a channel post that was automatically forwarded to the connected discussion group
     * @param Message|null $replyToMessage Optional. For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
     * @param User|null $viaBot Optional. Bot through which the message was sent
     * @param int|null $editDate Optional. Date the message was last edited in Unix time
     * @param bool|null $hasProtectedContent Optional. True, if the message can't be forwarded
     * @param string|null $mediaGroupId Optional. The unique identifier of a media message group this message belongs to
     * @param string|null $authorSignature Optional. Signature of the post author for messages in channels, or the custom title of an anonymous group administrator
     * @param string|null $text Optional. For text messages, the actual UTF-8 text of the message, 0-4096 characters
     * @param MessageEntity[]|null $entities Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
     * @param Animation|null $animation Optional. Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
     * @param Audio|null $audio Optional. Message is an audio file, information about the file
     * @param Document|null $document Optional. Message is a general file, information about the file
     * @param PhotoSize[]|null $photo Optional. Message is a photo, available sizes of the photo
     * @param Sticker|null $sticker Optional. Message is a sticker, information about the sticker
     * @param Video|null $video Optional. Message is a video, information about the video
     * @param VideoNote|null $videoNote Optional. Message is a video note, information about the video message
     * @param Voice|null $voice Optional. Message is a voice message, information about the file
     * @param string|null $caption Optional. Caption for the animation, audio, document, photo, video or voice, 0-1024 characters
     * @param MessageEntity[]|null $captionEntities Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
     * @param Contact|null $contact Optional. Message is a shared contact, information about the contact
     * @param Dice|null $dice Optional. Message is a dice with random value
     * @param Game|null $game Optional. Message is a game, information about the game. More about games »
     * @param Poll|null $poll Optional. Message is a native poll, information about the poll
     * @param Venue|null $venue Optional. Message is a venue, information about the venue. For backward compatibility, when this field is set, the location field will also be set
     * @param Location|null $location Optional. Message is a shared location, information about the location
     * @param User[]|null $newChatMembers Optional. New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
     * @param User|null $leftChatMember Optional. A member was removed from the group, information about them (this member may be the bot itself)
     * @param string|null $newChatTitle Optional. A chat title was changed to this value
     * @param PhotoSize[]|null $newChatPhoto Optional. A chat photo was change to this value
     * @param bool|null $deleteChatPhoto Optional. Service message: the chat photo was deleted
     * @param bool|null $groupChatCreated Optional. Service message: the group has been created
     * @param bool|null $supergroupChatCreated Optional. Service message: the supergroup has been created. This field can't be received in a message coming through updates, because bot can't be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup.
     * @param bool|null $channelChatCreated Optional. Service message: the channel has been created. This field can't be received in a message coming through updates, because bot can't be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel.
     * @param MessageAutoDeleteTimerChanged|null $messageAutoDeleteTimerChanged Optional. Service message: auto-delete timer settings changed in the chat
     * @param int|null $migrateToChatId Optional. The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @param int|null $migrateFromChatId Optional. The supergroup has been migrated from a group with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit integer or double-precision float type are safe for storing this identifier.
     * @param Message|null $pinnedMessage Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply.
     * @param Invoice|null $invoice Optional. Message is an invoice for a payment, information about the invoice. More about payments »
     * @param SuccessfulPayment|null $successfulPayment Optional. Message is a service message about a successful payment, information about the payment. More about payments »
     * @param string|null $connectedWebsite Optional. The domain name of the website on which the user has logged in. More about Telegram Login »
     * @param PassportData|null $passportData Optional. Telegram Passport data
     * @param ProximityAlertTriggered|null $proximityAlertTriggered Optional. Service message. A user in the chat triggered another user's proximity alert while sharing Live Location.
     * @param VideoChatScheduled|null $videoChatScheduled Optional. Service message: video chat scheduled
     * @param VideoChatStarted|null $videoChatStarted Optional. Service message: video chat started
     * @param VideoChatEnded|null $videoChatEnded Optional. Service message: video chat ended
     * @param VideoChatParticipantsInvited|null $videoChatParticipantsInvited Optional. Service message: new participants invited to a video chat
     * @param WebAppData|null $webAppData Optional. Service message: data sent by a Web App
     * @param InlineKeyboardMarkup|null $replyMarkup Optional. Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
     */
    public function __construct(
        public int $messageId,
        public ?User $from = null,
        public ?Chat $senderChat = null,
        public int $date,
        public Chat $chat,
        public ?User $forwardFrom = null,
        public ?Chat $forwardFromChat = null,
        public ?int $forwardFromMessageId = null,
        public ?string $forwardSignature = null,
        public ?string $forwardSenderName = null,
        public ?int $forwardDate = null,
        public ?bool $isAutomaticForward = null,
        public ?Message $replyToMessage = null,
        public ?User $viaBot = null,
        public ?int $editDate = null,
        public ?bool $hasProtectedContent = null,
        public ?string $mediaGroupId = null,
        public ?string $authorSignature = null,
        public ?string $text = null,
        public ?array $entities = null,
        public ?Animation $animation = null,
        public ?Audio $audio = null,
        public ?Document $document = null,
        public ?array $photo = null,
        public ?Sticker $sticker = null,
        public ?Video $video = null,
        public ?VideoNote $videoNote = null,
        public ?Voice $voice = null,
        public ?string $caption = null,
        public ?array $captionEntities = null,
        public ?Contact $contact = null,
        public ?Dice $dice = null,
        public ?Game $game = null,
        public ?Poll $poll = null,
        public ?Venue $venue = null,
        public ?Location $location = null,
        public ?array $newChatMembers = null,
        public ?User $leftChatMember = null,
        public ?string $newChatTitle = null,
        public ?array $newChatPhoto = null,
        public ?bool $deleteChatPhoto = null,
        public ?bool $groupChatCreated = null,
        public ?bool $supergroupChatCreated = null,
        public ?bool $channelChatCreated = null,
        public ?MessageAutoDeleteTimerChanged $messageAutoDeleteTimerChanged = null,
        public ?int $migrateToChatId = null,
        public ?int $migrateFromChatId = null,
        public ?Message $pinnedMessage = null,
        public ?Invoice $invoice = null,
        public ?SuccessfulPayment $successfulPayment = null,
        public ?string $connectedWebsite = null,
        public ?PassportData $passportData = null,
        public ?ProximityAlertTriggered $proximityAlertTriggered = null,
        public ?VideoChatScheduled $videoChatScheduled = null,
        public ?VideoChatStarted $videoChatStarted = null,
        public ?VideoChatEnded $videoChatEnded = null,
        public ?VideoChatParticipantsInvited $videoChatParticipantsInvited = null,
        public ?WebAppData $webAppData = null,
        public ?InlineKeyboardMarkup $replyMarkup = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['message_id'],
            isset($payload['from']) ? User::fromPayload($payload['from']) : null,
            isset($payload['sender_chat']) ? Chat::fromPayload($payload['sender_chat']) : null,
            $payload['date'],
            Chat::fromPayload($payload['chat']),
            isset($payload['forward_from']) ? User::fromPayload($payload['forward_from']) : null,
            isset($payload['forward_from_chat']) ? Chat::fromPayload($payload['forward_from_chat']) : null,
            $payload['forward_from_message_id'] ?? null,
            $payload['forward_signature'] ?? null,
            $payload['forward_sender_name'] ?? null,
            $payload['forward_date'] ?? null,
            $payload['is_automatic_forward'] ?? null,
            isset($payload['reply_to_message']) ? Message::fromPayload($payload['reply_to_message']) : null,
            isset($payload['via_bot']) ? User::fromPayload($payload['via_bot']) : null,
            $payload['edit_date'] ?? null,
            $payload['has_protected_content'] ?? null,
            $payload['media_group_id'] ?? null,
            $payload['author_signature'] ?? null,
            $payload['text'] ?? null,
            isset($payload['entities']) ? array_map(fn($t) => MessageEntity::fromPayload($t), $payload['entities']) : null,
            isset($payload['animation']) ? Animation::fromPayload($payload['animation']) : null,
            isset($payload['audio']) ? Audio::fromPayload($payload['audio']) : null,
            isset($payload['document']) ? Document::fromPayload($payload['document']) : null,
            isset($payload['photo']) ? array_map(fn($t) => PhotoSize::fromPayload($t), $payload['photo']) : null,
            isset($payload['sticker']) ? Sticker::fromPayload($payload['sticker']) : null,
            isset($payload['video']) ? Video::fromPayload($payload['video']) : null,
            isset($payload['video_note']) ? VideoNote::fromPayload($payload['video_note']) : null,
            isset($payload['voice']) ? Voice::fromPayload($payload['voice']) : null,
            $payload['caption'] ?? null,
            isset($payload['caption_entities']) ? array_map(fn($t) => MessageEntity::fromPayload($t), $payload['caption_entities']) : null,
            isset($payload['contact']) ? Contact::fromPayload($payload['contact']) : null,
            isset($payload['dice']) ? Dice::fromPayload($payload['dice']) : null,
            isset($payload['game']) ? Game::fromPayload($payload['game']) : null,
            isset($payload['poll']) ? Poll::fromPayload($payload['poll']) : null,
            isset($payload['venue']) ? Venue::fromPayload($payload['venue']) : null,
            isset($payload['location']) ? Location::fromPayload($payload['location']) : null,
            isset($payload['new_chat_members']) ? array_map(fn($t) => User::fromPayload($t), $payload['new_chat_members']) : null,
            isset($payload['left_chat_member']) ? User::fromPayload($payload['left_chat_member']) : null,
            $payload['new_chat_title'] ?? null,
            isset($payload['new_chat_photo']) ? array_map(fn($t) => PhotoSize::fromPayload($t), $payload['new_chat_photo']) : null,
            $payload['delete_chat_photo'] ?? null,
            $payload['group_chat_created'] ?? null,
            $payload['supergroup_chat_created'] ?? null,
            $payload['channel_chat_created'] ?? null,
            isset($payload['message_auto_delete_timer_changed']) ? MessageAutoDeleteTimerChanged::fromPayload($payload['message_auto_delete_timer_changed']) : null,
            $payload['migrate_to_chat_id'] ?? null,
            $payload['migrate_from_chat_id'] ?? null,
            isset($payload['pinned_message']) ? Message::fromPayload($payload['pinned_message']) : null,
            isset($payload['invoice']) ? Invoice::fromPayload($payload['invoice']) : null,
            isset($payload['successful_payment']) ? SuccessfulPayment::fromPayload($payload['successful_payment']) : null,
            $payload['connected_website'] ?? null,
            isset($payload['passport_data']) ? PassportData::fromPayload($payload['passport_data']) : null,
            isset($payload['proximity_alert_triggered']) ? ProximityAlertTriggered::fromPayload($payload['proximity_alert_triggered']) : null,
            isset($payload['video_chat_scheduled']) ? VideoChatScheduled::fromPayload($payload['video_chat_scheduled']) : null,
            isset($payload['video_chat_started']) ? VideoChatStarted::fromPayload($payload['video_chat_started']) : null,
            isset($payload['video_chat_ended']) ? VideoChatEnded::fromPayload($payload['video_chat_ended']) : null,
            isset($payload['video_chat_participants_invited']) ? VideoChatParticipantsInvited::fromPayload($payload['video_chat_participants_invited']) : null,
            isset($payload['web_app_data']) ? WebAppData::fromPayload($payload['web_app_data']) : null,
            isset($payload['reply_markup']) ? InlineKeyboardMarkup::fromPayload($payload['reply_markup']) : null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'message_id' => $this->messageId,
            'from' => $this->from,
            'sender_chat' => $this->senderChat,
            'date' => $this->date,
            'chat' => $this->chat,
            'forward_from' => $this->forwardFrom,
            'forward_from_chat' => $this->forwardFromChat,
            'forward_from_message_id' => $this->forwardFromMessageId,
            'forward_signature' => $this->forwardSignature,
            'forward_sender_name' => $this->forwardSenderName,
            'forward_date' => $this->forwardDate,
            'is_automatic_forward' => $this->isAutomaticForward,
            'reply_to_message' => $this->replyToMessage,
            'via_bot' => $this->viaBot,
            'edit_date' => $this->editDate,
            'has_protected_content' => $this->hasProtectedContent,
            'media_group_id' => $this->mediaGroupId,
            'author_signature' => $this->authorSignature,
            'text' => $this->text,
            'entities' => $this->entities,
            'animation' => $this->animation,
            'audio' => $this->audio,
            'document' => $this->document,
            'photo' => $this->photo,
            'sticker' => $this->sticker,
            'video' => $this->video,
            'video_note' => $this->videoNote,
            'voice' => $this->voice,
            'caption' => $this->caption,
            'caption_entities' => $this->captionEntities,
            'contact' => $this->contact,
            'dice' => $this->dice,
            'game' => $this->game,
            'poll' => $this->poll,
            'venue' => $this->venue,
            'location' => $this->location,
            'new_chat_members' => $this->newChatMembers,
            'left_chat_member' => $this->leftChatMember,
            'new_chat_title' => $this->newChatTitle,
            'new_chat_photo' => $this->newChatPhoto,
            'delete_chat_photo' => $this->deleteChatPhoto,
            'group_chat_created' => $this->groupChatCreated,
            'supergroup_chat_created' => $this->supergroupChatCreated,
            'channel_chat_created' => $this->channelChatCreated,
            'message_auto_delete_timer_changed' => $this->messageAutoDeleteTimerChanged,
            'migrate_to_chat_id' => $this->migrateToChatId,
            'migrate_from_chat_id' => $this->migrateFromChatId,
            'pinned_message' => $this->pinnedMessage,
            'invoice' => $this->invoice,
            'successful_payment' => $this->successfulPayment,
            'connected_website' => $this->connectedWebsite,
            'passport_data' => $this->passportData,
            'proximity_alert_triggered' => $this->proximityAlertTriggered,
            'video_chat_scheduled' => $this->videoChatScheduled,
            'video_chat_started' => $this->videoChatStarted,
            'video_chat_ended' => $this->videoChatEnded,
            'video_chat_participants_invited' => $this->videoChatParticipantsInvited,
            'web_app_data' => $this->webAppData,
            'reply_markup' => $this->replyMarkup,
        ]);
    }
}