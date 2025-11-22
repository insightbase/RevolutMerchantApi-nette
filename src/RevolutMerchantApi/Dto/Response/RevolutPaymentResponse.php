<?php

namespace RevolutMerchantApi\Dto\Response;

class RevolutPaymentResponse implements RevolutResponseInterface
{
    public function __construct(
        public string $id,
        public string $state,
        public string $createdAt,
        public string $updatedAt,
        public string $token,
        public int $amount,
        public string $currency,
        public ?int $settledAmount,
        public ?string $settledCurrency,
        public ?string $riskLevel,
        public array $fees,
        public array $paymentMethod,
        public ?string $orderId,
        public array $raw
    ) { }

    public static function fromArray(array $d): self
    {
        return new self(
            $d['id'],
            $d['state'],
            $d['created_at'],
            $d['updated_at'],
            $d['token'],
            $d['amount'],
            $d['currency'],
            $d['settled_amount']   ?? null,
            $d['settled_currency'] ?? null,
            $d['risk_level']       ?? null,
            $d['fees']             ?? [],
            $d['payment_method']   ?? [],
            $d['order_id']         ?? null,
            $d
        );
    }
}
