<?php
namespace RevolutMerchantApi\Dto\Response;

use RevolutMerchantApi\Enum\PaymentState;
use RevolutMerchantApi\Enum\CaptureMode;
use RevolutMerchantApi\Enum\ChallengeMode;

class RevolutOrderResponse implements RevolutResponseInterface
{
    public function __construct(
        public string $id,
        public string $token,
        public string $type,
        public PaymentState $state,
        public string $createdAt,
        public string $updatedAt,
        public int $amount,
        public string $currency,
        public int $outstandingAmount,
        public CaptureMode $captureMode,
        public string $checkoutUrl,
        public string $redirectUrl,
        public ChallengeMode $enforceChallenge,
        public array $raw
    ) { }

    public static function fromArray(array $d): self
    {
        return new self(
            $d['id'],
            $d['token'],
            $d['type'],
            PaymentState::from($d['state']),
            $d['created_at'],
            $d['updated_at'],
            $d['amount'],
            $d['currency'],
            $d['outstanding_amount'],
            CaptureMode::from($d['capture_mode']),
            $d['checkout_url'],
            $d['redirect_url'],
            ChallengeMode::from($d['enforce_challenge']),
            $d
        );
    }
}
