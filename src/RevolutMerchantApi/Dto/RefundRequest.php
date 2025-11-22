<?php
namespace RevolutMerchantApi\Dto;

class RefundRequest
{
    public function __construct(
        public int $amount,            // in minor units
        public ?string $reason = null
    ) { }

    public function toArray(): array
    {
        return array_filter([
            'amount' => $this->amount,
            'reason' => $this->reason,
        ]);
    }
}
