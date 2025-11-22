<?php
namespace RevolutMerchantApi\Dto\Response;

class RevolutErrorResponse implements RevolutResponseInterface
{
    public function __construct(
        public string $code,
        public string $message,
        public int $timestamp,
        public int $statusCode,
        public array $raw
    ) { }

    public static function fromArray(array $d, int $status): self
    {
        return new self(
            $d['code'] ?? 'unknown_error',
            $d['message'] ?? 'Unknown error',
            $d['timestamp'] ?? 0,
            $status,
            $d
        );
    }
}
