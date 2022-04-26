# Simple Telegram Bot Api [WIP]

[![Telegram bot api][ico-bot-api]][link-bot-api]
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![PHP Version >= 8.0][ico-php-v]][link-php-8-0]

Minimalist strongly-typed Telegram Bot API.

This package is heavily inspired by `tg-bot-api/bot-api-base`.

**BEWARE: This package is still in alpha.**

Read the [testing](#testing) section before using this package.

### What does this package provide?

-   It provides a way to interact with the Telegram API with strongly typed parameters.
-   It provides a way to catch updates in a webhook.

### What does this package NOT provide?

A framework for dealing with commands, inline queries or follow conversations.
Those are for you to implement.

### Supported Telegram Bot API

Supports Telegram Bot API 6.0 (April 16, 2022)

## Installation

Via Composer

```bash
composer require gusaln/simple-tg-bot-api
```

## Usage

You need to instantiate the `BotApi` class which provides all the methods of the Telegram Bot API.

```php
$botToken = '<bot token>';

$api = new \GusALN\TelegramBotApi\BotApi(
    $botToken,
    new \GusALN\TelegramBotApi\Client\GuzzleClient()
);

// If no ClientInterface is provided as second argument, a GuzzleClient is created by default.
$api = new \GusALN\TelegramBotApi\BotApi($botToken);
```

All the API methods have a corresponding method in the `BotApi` class, and that method takes in a `MethodRequest` object that takes all the arguments of said method.

```php
$userId = '<user id>';

$message = $api->sendMessage(
    new \GusALN\TelegramBotApi\MethodRequests\SendMessageRequest($userId, "Hello")
);

$editedMessage = $api->editMessageText(
    new \GusALN\TelegramBotApi\MethodRequests\EditMessageTextRequest(
        $message->chat->id,
        $message->messageId,
        "Good bye!"
    )
);
```

This way you are prevented from mistyping any parameters or messing up their types.

**WARNING: Methods like `editMessageText` can take a `chat_id` and a `message_id` for regular messages, or a `inline_message_id` for inline messages, but not the three at the same time.**
**Currently, this package does not provide a safeguard against this invalid state, but it may in the future.**
**For now, always read the constructor descriptions.**

For more examples, check the `examples` folder.

### Types

All the types from the Telegram Bot API, like `Update`, `Message`, and the like, are provided as clases in the `GusALN\TelegramBotApi\Types\` namespace.
They implement `JsonSerializable` and have a static `fromPayload(array $payload): self` that allows you to deserialize them.

The `fromPayload` method of abstract types, like `MenuButton` which has the child types `MenuButtonCommands`, `MenuButtonWebApp`, and `MenuButtonDefault`, return an instance of the specific child type where possible.
Most abstract types have a property which's value specifies its subtype.
Following with the `MethodButton` family of types, the property `type` can be either:

-   `commands` for `MenuButtonCommands`,
-   `web_app` for `MenuButtonWebApp`, or
-   `default` for `MenuButtonDefault`.

This values are provided as constants in all abstract types:

```php
// omitted code
abstract class MenuButton implements JsonSerializable
{
    public const MENU_BUTTON_COMMANDS_TYPE = 'commands';
    public const MENU_BUTTON_WEB_APP_TYPE = 'web_app';
    public const MENU_BUTTON_DEFAULT_TYPE = 'default';
    // omitted code
}
```

The only exception to this is the `InputMessageContent` family of types which do not have a specific property-value pair that defines then, and other methods are used to identified them.

### Enums

Enum classes are provided for certain _magic string_.
There are two at the moment: `GusALN\TelegramBotApi\Enums\ParseMode::*` and `GusALN\TelegramBotApi\Enums\ChatAction::*`.

You can specify the `parse_mode` parameter for the messages using the `ParseMode::*` constants.

```php
$message = $api->sendMessage(
    new \GusALN\TelegramBotApi\MethodRequests\SendMessageRequest(
        $userId,
        "<b>bold</b>, <strong>bold</strong>, <i>italic</i>, <em>italic</em>",
        parseMode: \GusALN\TelegramBotApi\Enums\ParseMode::HTML
    )
);
```

### Fetching updates from a webhook

The `WebhookUpdateFetcher` can parse an update from either a `Psr\Http\Message\RequestInterface` or a `string`.

```php
$fetcher = new \GusALN\TelegramBotApi\WebhookUpdateFetcher();
$update = $fetcher->fetch($request);
```

### Polling updates

Check an example inside the `examples/get_updates_polling.php`.

## What can I expect to change as the package matures?

A better API, which would include:

1. Factory methods inside some requests.
   For example, the `editMessageText` could take a `chat_id` and a `message_id` for regular messages, or a `inline_message_id` for inline messages.

2. General methods on the `BotApi` for common tasks.
   For example, having a `send` method that accepts all the requests that _send_ something (`sendMessage`, `sendPhoto`, `sendAudio`, etc.).

## Testing

> I don’t always test my code, but when I do, I test in production.

In all seriousness, expect test to manifest after I play around with the API enough to have a clear idea of shape I want it to have.
I have done some crude practical testing on a selection of all the methods to verify that they indeed work.

For the first beta release (0.1.0), there will be tests.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

If you discover any security related issues, please email git.gustavolopez.xyz@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-php-v]: https://img.shields.io/travis/php-v/gusaln/simple-tg-bot-api.svg?style=flat-square
[ico-bot-api]: https://img.shields.io/badge/Bot%20API-6.0-blue.svg?style=flat-square
[ico-version]: https://img.shields.io/packagist/v/gusaln/simple-tg-bot-api.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[link-bot-api]: https://core.telegram.org/bots/api
[link-packagist]: https://packagist.org/packages/gusaln/simple-tg-bot-api
[link-downloads]: https://packagist.org/packages/gusaln/simple-tg-bot-api
[link-php-8-0]: https://www.php.net/releases/8.0
