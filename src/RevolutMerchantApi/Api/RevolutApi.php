<?php
namespace RevolutMerchantApi\Api;

use RevolutMerchantApi\Dto\RevolutOrder;
use RevolutMerchantApi\Dto\RefundRequest;
use RevolutMerchantApi\Exception\RevolutException;
use RevolutMerchantApi\Dto\Response\{RevolutOrderResponse,
    RevolutErrorResponse,
    RevolutPaymentResponse,
    RevolutRefundResponse,
    RevolutListResponse,
    RevolutResponseInterface};

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
                $response['data']['code'] ?? 0
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
                $response['data']['code'] ?? 0
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
                $response['data']['code'] ?? 0
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
                $response['data']['code'] ?? 0
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
                $response['data']['code'] ?? 0
            );
        }

        return RevolutRefundResponse::fromArray($response['data']);
    }

}


