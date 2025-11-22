<?php
namespace RevolutMerchantApi\Api;

use RevolutMerchantApi\Dto\RefundRequest;
use RevolutMerchantApi\Dto\Response\{RevolutListResponse,
    RevolutOrderResponse,
    RevolutPaymentResponse,
    RevolutRefundResponse};
use RevolutMerchantApi\Dto\RevolutOrder;
use RevolutMerchantApi\Exception\RevolutException;

class RevolutApi
{
    public function __construct(
        private RevolutHttpClient $client
    )
    {
    }

    /**
     * @throws RevolutException
     */
    public function createOrder(RevolutOrder $order): RevolutOrderResponse
    {
        $response = $this->client->request('POST', '/orders', $order->toArray());

        if ($response['status'] >= 400) {
            throw new RevolutException(
                $response['data']['message'] ?? 'Revolut API error',
                $response['data']['code'] ?? null,
                $response['status']
            );
        }

        return RevolutOrderResponse::fromArray($response['data']);
    }

    /**
     * @throws RevolutException
     */
    public function getOrder(string $id): RevolutOrderResponse
    {
        $response = $this->client->request('GET', '/orders/' . $id);

        if ($response['status'] >= 400) {
            throw new RevolutException(
                $response['data']['message'] ?? 'Revolut API error',
                $response['data']['code'] ?? null,
                $response['status']
            );
        }

        return RevolutOrderResponse::fromArray($response['data']);
    }

    /**
     * @throws RevolutException
     */
    public function getPayment(string $paymentId): RevolutPaymentResponse
    {
        $response = $this->client->request('GET', '/payments/' . $paymentId);

        if ($response['status'] >= 400) {
            throw new RevolutException(
                $response['data']['message'] ?? 'Revolut API error',
                $response['data']['code'] ?? null,
                $response['status']
            );
        }

        return RevolutPaymentResponse::fromArray($response['data']);
    }

    /**
     * @throws RevolutException
     */
    public function listOrders(): RevolutListResponse
    {
        $response = $this->client->request('GET', '/orders');

        if ($response['status'] >= 400) {
            throw new RevolutException(
                $response['data']['message'] ?? 'Revolut API error',
                $response['data']['code'] ?? null,
                $response['status']
            );
        }

        return RevolutListResponse::fromArray($response['data']);
    }

    public function refund(string $orderId, RefundRequest $refund): RevolutRefundResponse
    {
        $response = $this->client->request('POST', "/orders/$orderId/refund", $refund->toArray());

        if ($response['status'] >= 400) {
            throw new RevolutException(
                $response['data']['message'] ?? 'Revolut API error',
                $response['data']['code'] ?? null,
                $response['status']
            );
        }

        return RevolutRefundResponse::fromArray($response['data']);
    }

}


