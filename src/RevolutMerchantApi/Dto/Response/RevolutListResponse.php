<?php
namespace RevolutMerchantApi\Dto\Response;

class RevolutListResponse implements RevolutResponseInterface
{
    public function __construct(
        public array $items,
        public array $raw
    ) { }

    public static function fromArray(array $d): self
    {
        return new self($d, $d);
    }
}
