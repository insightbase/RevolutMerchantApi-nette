<?php
namespace RevolutMerchantApi\Api;

use RevolutMerchantApi\Exception\RevolutException;

class RevolutHttpClient
{
    public function __construct(
        private readonly string $apiKey,
        private readonly string $apiUrl,
        private ?RevolutLogger $logger = null
    ) { }

    public function request(string $method, string $endpoint, array $data = []): array
    {
        $curl = curl_init();

        $opts = [
            CURLOPT_URL            => $this->apiUrl . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HEADER         => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Accept: application/json',
                'Revolut-Api-Version: 2023-09-01',
                'Authorization: Bearer ' . $this->apiKey,
            ],
        ];

        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $opts[CURLOPT_CUSTOMREQUEST] = $method;
            $opts[CURLOPT_POSTFIELDS] = json_encode($data);
        } elseif ($method === 'GET') {
            $opts[CURLOPT_HTTPGET] = true;
        }

        curl_setopt_array($curl, $opts);

        $response = curl_exec($curl);
        if ($response === false) {
            $err = curl_error($curl);
            curl_close($curl);
            throw new RevolutException('cURL error: ' . $err);
        }

        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $body = substr($response, $headerSize);
        $json = json_decode($body, true) ?? [];

        curl_close($curl);

        $this->logger?->logRequest($endpoint, $method, $data, $status, $json);

        return ['status' => $status, 'data' => $json];
    }
}
