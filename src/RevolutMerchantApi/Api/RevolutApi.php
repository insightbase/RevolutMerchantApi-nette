<?php
namespace RevolutMerchantApi\Api;

use RevolutMerchantApi\Dto\RevolutOrder;
use RevolutMerchantApi\Dto\RefundRequest;
use RevolutMerchantApi\Dto\Response\{
    RevolutOrderResponse,
    RevolutErrorResponse,
    RevolutRefundResponse,
    RevolutListResponse,
    RevolutResponseInterface
};

class RevolutApi
{
    public function __construct(
        private RevolutHttpClient $client
    ) { }

    public function createOrder(RevolutOrder $order): RevolutResponseInterface
    {
        return $this->handle(
            $this->client->request('POST', '/orders', $order->toArray())
        );
    }

    public function getOrder(string $id): RevolutResponseInterface
    {
        return $this->handle(
            $this->client->request('GET', '/orders/' . $id)
        );
    }

    public function listOrders(): RevolutResponseInterface
    {
        return $this->handle(
            $this->client->request('GET', '/orders')
        );
    }

    public function refund(string $orderId, RefundRequest $refund): RevolutResponseInterface
    {
        return $this->handle(
            $this->client->request('POST', "/orders/$orderId/refund", $refund->toArray())
        );
    }

    private function handle(array $response): RevolutResponseInterface
    {
        $status = $response['status'];
        $json   = $response['data'];

        return match ($status) {
            200, 201 => isset($json['checkout_url'])
                ? RevolutOrderResponse::fromArray($json)
                : (isset($json['id']) && isset($json['state']) && isset($json['amount'])
                    ? RevolutRefundResponse::fromArray($json)
                    : (is_array($json) ? RevolutListResponse::fromArray($json) : RevolutOrderResponse::fromArray($json))),
            default  => RevolutErrorResponse::fromArray($json ?? [], $status),
        };
    }
}
