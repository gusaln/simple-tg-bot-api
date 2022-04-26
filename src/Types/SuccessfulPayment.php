<?php

declare(strict_types=1);

namespace GusALN\TelegramBotApi\Types;

use GusALN\TelegramBotApi\Types\OrderInfo;
use JsonSerializable;

/**
 * This object contains basic information about a successful payment.
 */
class SuccessfulPayment implements JsonSerializable
{
    /**
     * @param string $currency Three-letter ISO 4217 currency code
     * @param int $totalAmount Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
     * @param string $invoicePayload Bot specified invoice payload
     * @param string|null $shippingOptionId Optional. Identifier of the shipping option chosen by the user
     * @param OrderInfo|null $orderInfo Optional. Order info provided by the user
     * @param string $telegramPaymentChargeId Telegram payment identifier
     * @param string $providerPaymentChargeId Provider payment identifier
     */
    public function __construct(
        public string $currency,
        public int $totalAmount,
        public string $invoicePayload,
        public ?string $shippingOptionId = null,
        public ?OrderInfo $orderInfo = null,
        public string $telegramPaymentChargeId,
        public string $providerPaymentChargeId,
    ) {
    }

    /** @phpstan-param array<string,mixed> $payload */
    public static function fromPayload(array $payload = []): self
    {
        return new self(
            $payload['currency'],
            $payload['total_amount'],
            $payload['invoice_payload'],
            $payload['shipping_option_id'] ?? null,
            isset($payload['order_info']) ? OrderInfo::fromPayload($payload['order_info']) : null,
            $payload['telegram_payment_charge_id'],
            $payload['provider_payment_charge_id'],
        );
    }

    public function jsonSerialize(): mixed
    {
        return array_filter([
            'currency' => $this->currency,
            'total_amount' => $this->totalAmount,
            'invoice_payload' => $this->invoicePayload,
            'shipping_option_id' => $this->shippingOptionId,
            'order_info' => $this->orderInfo,
            'telegram_payment_charge_id' => $this->telegramPaymentChargeId,
            'provider_payment_charge_id' => $this->providerPaymentChargeId,
        ]);
    }
}