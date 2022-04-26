<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\LabeledPrice;
use JsonSerializable;

/**
 * Represents the content of an invoice message to be sent as the result of an inline query.
 */
class InputInvoiceMessageContent extends InputMessageContent implements JsonSerializable
{
    /**
     * @param string $title Product name, 1-32 characters
     * @param string $description Product description, 1-255 characters
     * @param string $payload Bot-defined invoice payload, 1-128 bytes. This will not be displayed to the user, use for your internal processes.
     * @param string $providerToken Payment provider token, obtained via Botfather
     * @param string $currency Three-letter ISO 4217 currency code, see more on currencies
     * @param LabeledPrice[] $prices Price breakdown, a JSON-serialized list of components (e.g. product price, tax, discount, delivery cost, delivery tax, bonus, etc.)
     * @param int|null $maxTipAmount Optional. The maximum accepted amount for tips in the smallest units of the currency (integer, not float/double). For example, for a maximum tip of US$ 1.45 pass max_tip_amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies). Defaults to 0
     * @param int[]|null $suggestedTipAmounts Optional. A JSON-serialized array of suggested amounts of tip in the smallest units of the currency (integer, not float/double). At most 4 suggested tip amounts can be specified. The suggested tip amounts must be positive, passed in a strictly increased order and must not exceed max_tip_amount.
     * @param string|null $providerData Optional. A JSON-serialized object for data about the invoice, which will be shared with the payment provider. A detailed description of the required fields should be provided by the payment provider.
     * @param string|null $photoUrl Optional. URL of the product photo for the invoice. Can be a photo of the goods or a marketing image for a service. People like it better when they see what they are paying for.
     * @param int|null $photoSize Optional. Photo size
     * @param int|null $photoWidth Optional. Photo width
     * @param int|null $photoHeight Optional. Photo height
     * @param bool|null $needName Optional. Pass True, if you require the user's full name to complete the order
     * @param bool|null $needPhoneNumber Optional. Pass True, if you require the user's phone number to complete the order
     * @param bool|null $needEmail Optional. Pass True, if you require the user's email address to complete the order
     * @param bool|null $needShippingAddress Optional. Pass True, if you require the user's shipping address to complete the order
     * @param bool|null $sendPhoneNumberToProvider Optional. Pass True, if user's phone number should be sent to provider
     * @param bool|null $sendEmailToProvider Optional. Pass True, if user's email address should be sent to provider
     * @param bool|null $isFlexible Optional. Pass True, if the final price depends on the shipping method
     */
    public function __construct(
        public string $title,
        public string $description,
        public string $payload,
        public string $providerToken,
        public string $currency,
        public array $prices,
        public ?int $maxTipAmount = null,
        public ?array $suggestedTipAmounts = null,
        public ?string $providerData = null,
        public ?string $photoUrl = null,
        public ?int $photoSize = null,
        public ?int $photoWidth = null,
        public ?int $photoHeight = null,
        public ?bool $needName = null,
        public ?bool $needPhoneNumber = null,
        public ?bool $needEmail = null,
        public ?bool $needShippingAddress = null,
        public ?bool $sendPhoneNumberToProvider = null,
        public ?bool $sendEmailToProvider = null,
        public ?bool $isFlexible = null,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload): self
    {
        return new self(
            $payload['title'],
            $payload['description'],
            $payload['payload'],
            $payload['provider_token'],
            $payload['currency'],
            array_map(fn($t) => LabeledPrice::fromPayload($t), $payload['prices']),
            $payload['max_tip_amount'] ?? null,
            $payload['suggested_tip_amounts'] ?? null,
            $payload['provider_data'] ?? null,
            $payload['photo_url'] ?? null,
            $payload['photo_size'] ?? null,
            $payload['photo_width'] ?? null,
            $payload['photo_height'] ?? null,
            $payload['need_name'] ?? null,
            $payload['need_phone_number'] ?? null,
            $payload['need_email'] ?? null,
            $payload['need_shipping_address'] ?? null,
            $payload['send_phone_number_to_provider'] ?? null,
            $payload['send_email_to_provider'] ?? null,
            $payload['is_flexible'] ?? null,
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'title' => $this->title,
            'description' => $this->description,
            'payload' => $this->payload,
            'provider_token' => $this->providerToken,
            'currency' => $this->currency,
            'prices' => $this->prices,
            'max_tip_amount' => $this->maxTipAmount,
            'suggested_tip_amounts' => $this->suggestedTipAmounts,
            'provider_data' => $this->providerData,
            'photo_url' => $this->photoUrl,
            'photo_size' => $this->photoSize,
            'photo_width' => $this->photoWidth,
            'photo_height' => $this->photoHeight,
            'need_name' => $this->needName,
            'need_phone_number' => $this->needPhoneNumber,
            'need_email' => $this->needEmail,
            'need_shipping_address' => $this->needShippingAddress,
            'send_phone_number_to_provider' => $this->sendPhoneNumberToProvider,
            'send_email_to_provider' => $this->sendEmailToProvider,
            'is_flexible' => $this->isFlexible,
        ]);
    }
}