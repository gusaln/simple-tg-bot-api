<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi;

use GusALN\TelegramBotApi\MethodRequests\AddStickerToSetRequest;
use GusALN\TelegramBotApi\MethodRequests\AnswerCallbackQueryRequest;
use GusALN\TelegramBotApi\MethodRequests\AnswerInlineQueryRequest;
use GusALN\TelegramBotApi\MethodRequests\AnswerPreCheckoutQueryRequest;
use GusALN\TelegramBotApi\MethodRequests\AnswerShippingQueryRequest;
use GusALN\TelegramBotApi\MethodRequests\AnswerWebAppQueryRequest;
use GusALN\TelegramBotApi\MethodRequests\ApproveChatJoinRequestRequest;
use GusALN\TelegramBotApi\MethodRequests\BanChatMemberRequest;
use GusALN\TelegramBotApi\MethodRequests\BanChatSenderChatRequest;
use GusALN\TelegramBotApi\MethodRequests\CloseRequest;
use GusALN\TelegramBotApi\MethodRequests\CopyMessageRequest;
use GusALN\TelegramBotApi\MethodRequests\CreateChatInviteLinkRequest;
use GusALN\TelegramBotApi\MethodRequests\CreateNewStickerSetRequest;
use GusALN\TelegramBotApi\MethodRequests\DeclineChatJoinRequestRequest;
use GusALN\TelegramBotApi\MethodRequests\DeleteChatPhotoRequest;
use GusALN\TelegramBotApi\MethodRequests\DeleteChatStickerSetRequest;
use GusALN\TelegramBotApi\MethodRequests\DeleteMessageRequest;
use GusALN\TelegramBotApi\MethodRequests\DeleteMyCommandsRequest;
use GusALN\TelegramBotApi\MethodRequests\DeleteStickerFromSetRequest;
use GusALN\TelegramBotApi\MethodRequests\DeleteWebhookRequest;
use GusALN\TelegramBotApi\MethodRequests\EditChatInviteLinkRequest;
use GusALN\TelegramBotApi\MethodRequests\EditMessageCaptionRequest;
use GusALN\TelegramBotApi\MethodRequests\EditMessageLiveLocationRequest;
use GusALN\TelegramBotApi\MethodRequests\EditMessageMediaRequest;
use GusALN\TelegramBotApi\MethodRequests\EditMessageReplyMarkupRequest;
use GusALN\TelegramBotApi\MethodRequests\EditMessageTextRequest;
use GusALN\TelegramBotApi\MethodRequests\ExportChatInviteLinkRequest;
use GusALN\TelegramBotApi\MethodRequests\ForwardMessageRequest;
use GusALN\TelegramBotApi\MethodRequests\GetChatAdministratorsRequest;
use GusALN\TelegramBotApi\MethodRequests\GetChatMemberCountRequest;
use GusALN\TelegramBotApi\MethodRequests\GetChatMemberRequest;
use GusALN\TelegramBotApi\MethodRequests\GetChatMenuButtonRequest;
use GusALN\TelegramBotApi\MethodRequests\GetChatRequest;
use GusALN\TelegramBotApi\MethodRequests\GetFileRequest;
use GusALN\TelegramBotApi\MethodRequests\GetGameHighScoresRequest;
use GusALN\TelegramBotApi\MethodRequests\GetMeRequest;
use GusALN\TelegramBotApi\MethodRequests\GetMyCommandsRequest;
use GusALN\TelegramBotApi\MethodRequests\GetMyDefaultAdministratorRightsRequest;
use GusALN\TelegramBotApi\MethodRequests\GetStickerSetRequest;
use GusALN\TelegramBotApi\MethodRequests\GetUpdatesRequest;
use GusALN\TelegramBotApi\MethodRequests\GetUserProfilePhotosRequest;
use GusALN\TelegramBotApi\MethodRequests\GetWebhookInfoRequest;
use GusALN\TelegramBotApi\MethodRequests\LeaveChatRequest;
use GusALN\TelegramBotApi\MethodRequests\LogOutRequest;
use GusALN\TelegramBotApi\MethodRequests\PinChatMessageRequest;
use GusALN\TelegramBotApi\MethodRequests\PromoteChatMemberRequest;
use GusALN\TelegramBotApi\MethodRequests\RestrictChatMemberRequest;
use GusALN\TelegramBotApi\MethodRequests\RevokeChatInviteLinkRequest;
use GusALN\TelegramBotApi\MethodRequests\SendAnimationRequest;
use GusALN\TelegramBotApi\MethodRequests\SendAudioRequest;
use GusALN\TelegramBotApi\MethodRequests\SendChatActionRequest;
use GusALN\TelegramBotApi\MethodRequests\SendContactRequest;
use GusALN\TelegramBotApi\MethodRequests\SendDiceRequest;
use GusALN\TelegramBotApi\MethodRequests\SendDocumentRequest;
use GusALN\TelegramBotApi\MethodRequests\SendGameRequest;
use GusALN\TelegramBotApi\MethodRequests\SendInvoiceRequest;
use GusALN\TelegramBotApi\MethodRequests\SendLocationRequest;
use GusALN\TelegramBotApi\MethodRequests\SendMediaGroupRequest;
use GusALN\TelegramBotApi\MethodRequests\SendMessageRequest;
use GusALN\TelegramBotApi\MethodRequests\SendPhotoRequest;
use GusALN\TelegramBotApi\MethodRequests\SendPollRequest;
use GusALN\TelegramBotApi\MethodRequests\SendStickerRequest;
use GusALN\TelegramBotApi\MethodRequests\SendVenueRequest;
use GusALN\TelegramBotApi\MethodRequests\SendVideoNoteRequest;
use GusALN\TelegramBotApi\MethodRequests\SendVideoRequest;
use GusALN\TelegramBotApi\MethodRequests\SendVoiceRequest;
use GusALN\TelegramBotApi\MethodRequests\SetChatAdministratorCustomTitleRequest;
use GusALN\TelegramBotApi\MethodRequests\SetChatDescriptionRequest;
use GusALN\TelegramBotApi\MethodRequests\SetChatMenuButtonRequest;
use GusALN\TelegramBotApi\MethodRequests\SetChatPermissionsRequest;
use GusALN\TelegramBotApi\MethodRequests\SetChatPhotoRequest;
use GusALN\TelegramBotApi\MethodRequests\SetChatStickerSetRequest;
use GusALN\TelegramBotApi\MethodRequests\SetChatTitleRequest;
use GusALN\TelegramBotApi\MethodRequests\SetGameScoreRequest;
use GusALN\TelegramBotApi\MethodRequests\SetMyCommandsRequest;
use GusALN\TelegramBotApi\MethodRequests\SetMyDefaultAdministratorRightsRequest;
use GusALN\TelegramBotApi\MethodRequests\SetPassportDataErrorsRequest;
use GusALN\TelegramBotApi\MethodRequests\SetStickerPositionInSetRequest;
use GusALN\TelegramBotApi\MethodRequests\SetStickerSetThumbRequest;
use GusALN\TelegramBotApi\MethodRequests\SetWebhookRequest;
use GusALN\TelegramBotApi\MethodRequests\StopMessageLiveLocationRequest;
use GusALN\TelegramBotApi\MethodRequests\StopPollRequest;
use GusALN\TelegramBotApi\MethodRequests\UnbanChatMemberRequest;
use GusALN\TelegramBotApi\MethodRequests\UnbanChatSenderChatRequest;
use GusALN\TelegramBotApi\MethodRequests\UnpinAllChatMessagesRequest;
use GusALN\TelegramBotApi\MethodRequests\UnpinChatMessageRequest;
use GusALN\TelegramBotApi\MethodRequests\UploadStickerFileRequest;
use GusALN\TelegramBotApi\Types\BotCommand;
use GusALN\TelegramBotApi\Types\Chat;
use GusALN\TelegramBotApi\Types\ChatAdministratorRights;
use GusALN\TelegramBotApi\Types\ChatInviteLink;
use GusALN\TelegramBotApi\Types\ChatMember;
use GusALN\TelegramBotApi\Types\File;
use GusALN\TelegramBotApi\Types\GameHighScore;
use GusALN\TelegramBotApi\Types\MenuButton;
use GusALN\TelegramBotApi\Types\Message;
use GusALN\TelegramBotApi\Types\MessageId;
use GusALN\TelegramBotApi\Types\Poll;
use GusALN\TelegramBotApi\Types\SentWebAppMessage;
use GusALN\TelegramBotApi\Types\StickerSet;
use GusALN\TelegramBotApi\Types\Update;
use GusALN\TelegramBotApi\Types\User;
use GusALN\TelegramBotApi\Types\UserProfilePhotos;
use GusALN\TelegramBotApi\Types\WebhookInfo;

class BotApi extends BaseBotApi
{
    /**
     * Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned.
     *
     * @return Update[]
     */
    public function getUpdates(GetUpdatesRequest $request): array
    {
        return array_map(fn ($p) => Update::fromPayload($p), $this->call($request)->getPayload());
    }

    /**
     * Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns True on success.
     * If you'd like to make sure that the Webhook request comes from Telegram, we recommend using a secret path in the URL, e.g. https://www.example.com/<token>. Since nobody else knows your bot's token, you can be pretty sure it's us.
     */
    public function setWebhook(SetWebhookRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success.
     */
    public function deleteWebhook(DeleteWebhookRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If the bot is using getUpdates, will return an object with the url field empty.
     */
    public function getWebhookInfo(GetWebhookInfoRequest $request): WebhookInfo
    {
        return WebhookInfo::fromPayload($this->call($request)->getPayload());
    }

    /**
     * A simple method for testing your bot's authentication token. Requires no parameters. Returns basic information about the bot in form of a User object.
     */
    public function getMe(GetMeRequest $request): User
    {
        return User::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to log out from the cloud Bot API server before launching the bot locally. You must log out the bot before running it locally, otherwise there is no guarantee that the bot will receive updates. After a successful call, you can immediately log in on a local server, but will not be able to log in back to the cloud Bot API server for 10 minutes. Returns True on success. Requires no parameters.
     */
    public function logOut(LogOutRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to close the bot instance before moving it from one local server to another. You need to delete the webhook before calling this method to ensure that the bot isn't launched again after server restart. The method will return error 429 in the first 10 minutes after the bot is launched. Returns True on success. Requires no parameters.
     */
    public function close(CloseRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to send text messages. On success, the sent Message is returned.
     */
    public function sendMessage(SendMessageRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to forward messages of any kind. Service messages can't be forwarded. On success, the sent Message is returned.
     */
    public function forwardMessage(ForwardMessageRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to copy messages of any kind. Service messages and invoice messages can't be copied. The method is analogous to the method forwardMessage, but the copied message doesn't have a link to the original message. Returns the MessageId of the sent message on success.
     */
    public function copyMessage(CopyMessageRequest $request): MessageId
    {
        return MessageId::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send photos. On success, the sent Message is returned.
     */
    public function sendPhoto(SendPhotoRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .MP3 or .M4A format. On success, the sent Message is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
     * For sending voice messages, use the sendVoice method instead.
     */
    public function sendAudio(SendAudioRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send general files. On success, the sent Message is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
     */
    public function sendDocument(SendDocumentRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document). On success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
     */
    public function sendVideo(SendVideoRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
     */
    public function sendAnimation(SendAnimationRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .OGG file encoded with OPUS (other formats may be sent as Audio or Document). On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
     */
    public function sendVoice(SendVoiceRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long. Use this method to send video messages. On success, the sent Message is returned.
     */
    public function sendVideoNote(SendVideoNoteRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send a group of photos, videos, documents or audios as an album. Documents and audio files can be only grouped in an album with messages of the same type. On success, an array of Messages that were sent is returned.
     *
     * @return Message[]
     */
    public function sendMediaGroup(SendMediaGroupRequest $request): array
    {
        return array_map(fn ($p) => Message::fromPayload($p), $this->call($request)->getPayload());
    }

    /**
     * Use this method to send point on the map. On success, the sent Message is returned.
     */
    public function sendLocation(SendLocationRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to edit live location messages. A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     */
    public function editMessageLiveLocation(EditMessageLiveLocationRequest $request): Message|bool
    {
        return is_bool($payload = $this->call($request)->getPayload()) ? $payload : Message::fromPayload($payload);
    }

    /**
     * Use this method to stop updating a live location message before live_period expires. On success, if the message is not an inline message, the edited Message is returned, otherwise True is returned.
     */
    public function stopMessageLiveLocation(StopMessageLiveLocationRequest $request): Message|bool
    {
        return is_bool($payload = $this->call($request)->getPayload()) ? $payload : Message::fromPayload($payload);
    }

    /**
     * Use this method to send information about a venue. On success, the sent Message is returned.
     */
    public function sendVenue(SendVenueRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send phone contacts. On success, the sent Message is returned.
     */
    public function sendContact(SendContactRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send a native poll. On success, the sent Message is returned.
     */
    public function sendPoll(SendPollRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send an animated emoji that will display a random value. On success, the sent Message is returned.
     */
    public function sendDice(SendDiceRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns True on success.
     * We only recommend using this method when a response from the bot will take a noticeable amount of time to arrive.
     */
    public function sendChatAction(SendChatActionRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
     */
    public function getUserProfilePhotos(GetUserProfilePhotosRequest $request): UserProfilePhotos
    {
        return UserProfilePhotos::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
     * Note: This function may not preserve the original file name and MIME type. You should save the file's MIME type and name (if available) when the File object is received.
     */
    public function getFile(GetFileRequest $request): File
    {
        return File::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to ban a user in a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     */
    public function banChatMember(BanChatMemberRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to unban a previously banned user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. By default, this method guarantees that after the call the user is not a member of the chat, but will be able to join it. So if the user is a member of the chat they will also be removed from the chat. If you don't want this, use the parameter only_if_banned. Returns True on success.
     */
    public function unbanChatMember(UnbanChatMemberRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights. Pass True for all permissions to lift restrictions from a user. Returns True on success.
     */
    public function restrictChatMember(RestrictChatMemberRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Pass False for all boolean parameters to demote a user. Returns True on success.
     */
    public function promoteChatMember(PromoteChatMemberRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns True on success.
     */
    public function setChatAdministratorCustomTitle(SetChatAdministratorCustomTitleRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to ban a channel chat in a supergroup or a channel. Until the chat is unbanned, the owner of the banned chat won't be able to send messages on behalf of any of their channels. The bot must be an administrator in the supergroup or channel for this to work and must have the appropriate administrator rights. Returns True on success.
     */
    public function banChatSenderChat(BanChatSenderChatRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to unban a previously banned channel chat in a supergroup or channel. The bot must be an administrator for this to work and must have the appropriate administrator rights. Returns True on success.
     */
    public function unbanChatSenderChat(UnbanChatSenderChatRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members administrator rights. Returns True on success.
     */
    public function setChatPermissions(SetChatPermissionsRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to generate a new primary invite link for a chat; any previously generated primary link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the new invite link as String on success.
     */
    public function exportChatInviteLink(ExportChatInviteLinkRequest $request): string
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to create an additional invite link for a chat. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. The link can be revoked using the method revokeChatInviteLink. Returns the new invite link as ChatInviteLink object.
     */
    public function createChatInviteLink(CreateChatInviteLinkRequest $request): ChatInviteLink
    {
        return ChatInviteLink::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to edit a non-primary invite link created by the bot. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the edited invite link as a ChatInviteLink object.
     */
    public function editChatInviteLink(EditChatInviteLinkRequest $request): ChatInviteLink
    {
        return ChatInviteLink::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to revoke an invite link created by the bot. If the primary link is revoked, a new link is automatically generated. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns the revoked invite link as ChatInviteLink object.
     */
    public function revokeChatInviteLink(RevokeChatInviteLinkRequest $request): ChatInviteLink
    {
        return ChatInviteLink::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to approve a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right. Returns True on success.
     */
    public function approveChatJoinRequest(ApproveChatJoinRequestRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to decline a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right. Returns True on success.
     */
    public function declineChatJoinRequest(DeclineChatJoinRequestRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     */
    public function setChatPhoto(SetChatPhotoRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     */
    public function deleteChatPhoto(DeleteChatPhotoRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     */
    public function setChatTitle(SetChatTitleRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to change the description of a group, a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Returns True on success.
     */
    public function setChatDescription(SetChatDescriptionRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to add a message to the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel. Returns True on success.
     */
    public function pinChatMessage(PinChatMessageRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to remove a message from the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel. Returns True on success.
     */
    public function unpinChatMessage(UnpinChatMessageRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to clear the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' administrator right in a supergroup or 'can_edit_messages' administrator right in a channel. Returns True on success.
     */
    public function unpinAllChatMessages(UnpinAllChatMessagesRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
     */
    public function leaveChat(LeaveChatRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
     */
    public function getChat(GetChatRequest $request): Chat
    {
        return Chat::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots. If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
     *
     * @return ChatMember[]
     */
    public function getChatAdministrators(GetChatAdministratorsRequest $request): array
    {
        return array_map(fn ($p) => ChatMember::fromPayload($p), $this->call($request)->getPayload());
    }

    /**
     * Use this method to get the number of members in a chat. Returns Int on success.
     */
    public function getChatMemberCount(GetChatMemberCountRequest $request): int
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to get information about a member of a chat. Returns a ChatMember object on success.
     */
    public function getChatMember(GetChatMemberRequest $request): ChatMember
    {
        return ChatMember::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
     */
    public function setChatStickerSet(SetChatStickerSetRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
     */
    public function deleteChatStickerSet(DeleteChatStickerSetRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, True is returned.
     */
    public function answerCallbackQuery(AnswerCallbackQueryRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to change the list of the bot's commands. See https://core.telegram.org/bots#commands for more details about bot commands. Returns True on success.
     */
    public function setMyCommands(SetMyCommandsRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users. Returns True on success.
     */
    public function deleteMyCommands(DeleteMyCommandsRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to get the current list of the bot's commands for the given scope and user language. Returns Array of BotCommand on success. If commands aren't set, an empty list is returned.
     *
     * @return BotCommand[]
     */
    public function getMyCommands(GetMyCommandsRequest $request): array
    {
        return array_map(fn ($p) => BotCommand::fromPayload($p), $this->call($request)->getPayload());
    }

    /**
     * Use this method to change the bot's menu button in a private chat, or the default menu button. Returns True on success.
     */
    public function setChatMenuButton(SetChatMenuButtonRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to get the current value of the bot's menu button in a private chat, or the default menu button. Returns MenuButton on success.
     */
    public function getChatMenuButton(GetChatMenuButtonRequest $request): MenuButton
    {
        return MenuButton::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to change the default administrator rights requested by the bot when it's added as an administrator to groups or channels. These rights will be suggested to users, but they are are free to modify the list before adding the bot. Returns True on success.
     */
    public function setMyDefaultAdministratorRights(SetMyDefaultAdministratorRightsRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to get the current default administrator rights of the bot. Returns ChatAdministratorRights on success.
     */
    public function getMyDefaultAdministratorRights(GetMyDefaultAdministratorRightsRequest $request): ChatAdministratorRights
    {
        return ChatAdministratorRights::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to edit text and game messages. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     */
    public function editMessageText(EditMessageTextRequest $request): Message|bool
    {
        return is_bool($payload = $this->call($request)->getPayload()) ? $payload : Message::fromPayload($payload);
    }

    /**
     * Use this method to edit captions of messages. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     */
    public function editMessageCaption(EditMessageCaptionRequest $request): Message|bool
    {
        return is_bool($payload = $this->call($request)->getPayload()) ? $payload : Message::fromPayload($payload);
    }

    /**
     * Use this method to edit animation, audio, document, photo, or video messages. If a message is part of a message album, then it can be edited only to an audio for audio albums, only to a document for document albums and to a photo or a video otherwise. When an inline message is edited, a new file can't be uploaded; use a previously uploaded file via its file_id or specify a URL. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     */
    public function editMessageMedia(EditMessageMediaRequest $request): Message|bool
    {
        return is_bool($payload = $this->call($request)->getPayload()) ? $payload : Message::fromPayload($payload);
    }

    /**
     * Use this method to edit only the reply markup of messages. On success, if the edited message is not an inline message, the edited Message is returned, otherwise True is returned.
     */
    public function editMessageReplyMarkup(EditMessageReplyMarkupRequest $request): Message|bool
    {
        return is_bool($payload = $this->call($request)->getPayload()) ? $payload : Message::fromPayload($payload);
    }

    /**
     * Use this method to stop a poll which was sent by the bot. On success, the stopped Poll is returned.
     */
    public function stopPoll(StopPollRequest $request): Poll
    {
        return Poll::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to delete a message, including service messages, with the following limitations:- A message can only be deleted if it was sent less than 48 hours ago.- A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.- Bots can delete outgoing messages in private chats, groups, and supergroups.- Bots can delete incoming messages in private chats.- Bots granted can_post_messages permissions can delete outgoing messages in channels.- If the bot is an administrator of a group, it can delete any message there.- If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.Returns True on success.
     */
    public function deleteMessage(DeleteMessageRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to send static .WEBP, animated .TGS, or video .WEBM stickers. On success, the sent Message is returned.
     */
    public function sendSticker(SendStickerRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to get a sticker set. On success, a StickerSet object is returned.
     */
    public function getStickerSet(GetStickerSetRequest $request): StickerSet
    {
        return StickerSet::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to upload a .PNG file with a sticker for later use in createNewStickerSet and addStickerToSet methods (can be used multiple times). Returns the uploaded File on success.
     */
    public function uploadStickerFile(UploadStickerFileRequest $request): File
    {
        return File::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to create a new sticker set owned by a user. The bot will be able to edit the sticker set thus created. You must use exactly one of the fields png_sticker, tgs_sticker, or webm_sticker. Returns True on success.
     */
    public function createNewStickerSet(CreateNewStickerSetRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to add a new sticker to a set created by the bot. You must use exactly one of the fields png_sticker, tgs_sticker, or webm_sticker. Animated stickers can be added to animated sticker sets and only to them. Animated sticker sets can have up to 50 stickers. Static sticker sets can have up to 120 stickers. Returns True on success.
     */
    public function addStickerToSet(AddStickerToSetRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to move a sticker in a set created by the bot to a specific position. Returns True on success.
     */
    public function setStickerPositionInSet(SetStickerPositionInSetRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to delete a sticker from a set created by the bot. Returns True on success.
     */
    public function deleteStickerFromSet(DeleteStickerFromSetRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to set the thumbnail of a sticker set. Animated thumbnails can be set for animated sticker sets only. Video thumbnails can be set only for video sticker sets only. Returns True on success.
     */
    public function setStickerSetThumb(SetStickerSetThumbRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to send answers to an inline query. On success, True is returned.No more than 50 results per query are allowed.
     */
    public function answerInlineQuery(AnswerInlineQueryRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to set the result of an interaction with a Web App and send a corresponding message on behalf of the user to the chat from which the query originated. On success, a SentWebAppMessage object is returned.
     */
    public function answerWebAppQuery(AnswerWebAppQueryRequest $request): SentWebAppMessage
    {
        return SentWebAppMessage::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to send invoices. On success, the sent Message is returned.
     */
    public function sendInvoice(SendInvoiceRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries. On success, True is returned.
     */
    public function answerShippingQuery(AnswerShippingQueryRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query. Use this method to respond to such pre-checkout queries. On success, True is returned. Note: The Bot API must receive an answer within 10 seconds after the pre-checkout query was sent.
     */
    public function answerPreCheckoutQuery(AnswerPreCheckoutQueryRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Informs a user that some of the Telegram Passport elements they provided contains errors. The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change). Returns True on success.
     * Use this if the data submitted by the user doesn't satisfy the standards your service requires for any reason. For example, if a birthday date seems invalid, a submitted document is blurry, a scan shows evidence of tampering, etc. Supply some details in the error message to make sure the user knows how to correct the issues.
     */
    public function setPassportDataErrors(SetPassportDataErrorsRequest $request): bool
    {
        return $this->call($request)->getPayload();
    }

    /**
     * Use this method to send a game. On success, the sent Message is returned.
     */
    public function sendGame(SendGameRequest $request): Message
    {
        return Message::fromPayload($this->call($request)->getPayload());
    }

    /**
     * Use this method to set the score of the specified user in a game message. On success, if the message is not an inline message, the Message is returned, otherwise True is returned. Returns an error, if the new score is not greater than the user's current score in the chat and force is False.
     */
    public function setGameScore(SetGameScoreRequest $request): Message|bool
    {
        return is_bool($payload = $this->call($request)->getPayload()) ? $payload : Message::fromPayload($payload);
    }

    /**
     * Use this method to get data for high score tables. Will return the score of the specified user and several of their neighbors in a game. On success, returns an Array of GameHighScore objects.
     *
     * @return GameHighScore[]
     */
    public function getGameHighScores(GetGameHighScoresRequest $request): array
    {
        return array_map(fn ($p) => GameHighScore::fromPayload($p), $this->call($request)->getPayload());
    }
}
