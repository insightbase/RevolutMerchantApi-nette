<?php
namespace RevolutMerchantApi\Dto\Response;

class RevolutRefundResponse implements RevolutResponseInterface
{
    public function __construct(
        public string $id,
        public string $state,
        public int $amount,
        public string $currency,
        public array $raw
    ) { }

    public static function fromArray(array $d): self
    {
        return new self(
            $d['id'],
            $d['state'],
            $d['amount'],
            $d['currency'],
            $d
        );
    }
}
