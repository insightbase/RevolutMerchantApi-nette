# RevolutMerchantApi

PHP client pro **Revolut Merchant API** s podporou **Nette DI** a **Tracy panelu**.

## Instalace

Pomocí Composeru:

```bash
composer require insightbase/revolut-merchant-api-nette
```
Požadavky

```
PHP >= 8.1
ext-curl
Nette DI
Tracy (pro debug panel)
```

Použití
```
use RevolutMerchantApi\Api\RevolutHttpClient;
use RevolutMerchantApi\Api\RevolutApi;
use RevolutMerchantApi\Dto\RevolutOrder;
use RevolutMerchantApi\Enum\CaptureMode;
use RevolutMerchantApi\Enum\ChallengeMode;

$client = new RevolutHttpClient('TVUJ_API_KEY', 'https://merchant.revolut.com/api');
$api = new RevolutApi($client);

$order = (new RevolutOrder())
    ->setAmount(50.25)
    ->setCurrency('GBP')
    ->setCaptureMode(CaptureMode::AUTOMATIC)
    ->setEnforceChallenge(ChallengeMode::AUTOMATIC)
    ->setDescription('Ukázková platba');

$response = $api->createOrder($order);

var_dump($response);
```

Order payments:
```
try {
    $payments = $revolut->getOrderPayments($orderId);

    foreach ($payments->items as $payment) {
        dump($payment['id'], $payment['state'], $payment['payment_method']);
    }

} catch (RevolutException $e) {
    dump($e->errorCode, $e->httpStatus, $e->getMessage());
}
```


Payment detail
```
use RevolutMerchantApi\Api\RevolutApi;
use RevolutMerchantApi\Dto\Response\RevolutPaymentResponse;
use RevolutMerchantApi\Dto\Response\RevolutException;

/** @var RevolutApi $api */
$api = $this->revolutMerchantApi; // v Nette přes DI

$paymentId = '6633855a-0e4f-a768-8b2c-e765d8872505';
$response = $api->getPayment($paymentId);

if ($response instanceof RevolutPaymentResponse) {
    dump($response->state, $response->amount, $response->paymentMethod);
} elseif ($response instanceof RevolutException) {
    dump($response->statusCode, $response->raw); // raw['errorId'], raw['code'] atd.
}
```

Nette DI Extension
```
extensions:
    revolutMerchantApi: RevolutMerchantApi\Nette\RevolutMerchantApiExtension

revolutMerchantApi:
    apiKey: %revolutApiKey%
    apiUrl: https://merchant.revolut.com/api
    debug: true
```
Tracy Panel

Automaticky zobrazí všechny požadavky v Tracy debug baru.
