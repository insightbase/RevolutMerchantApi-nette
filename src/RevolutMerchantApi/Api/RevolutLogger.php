<?php
namespace RevolutMerchantApi\Api;

class RevolutLogger
{
    public array $logs = [];

    public function logRequest(string $endpoint, string $method, array $payload, int $status, array $response): void
    {
        $this->logs[] = [
            'endpoint' => $endpoint,
            'method' => $method,
            'payload' => $payload,
            'status' => $status,
            'response' => $response,
            'time' => date('Y-m-d H:i:s'),
        ];
    }
}
