<?php

namespace RevolutMerchantApi\Dto\Response;

class RevolutOrderPaymentsResponse implements RevolutResponseInterface
{
    /**
     * @param array<array{
     *     id: string,
     *     order_id: string,
     *     state: string,
     *     payment_method: array
     * }> $items
     */
    public function __construct(
        public array $items,
        public array $raw,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data,
            $data
        );
    }
}
