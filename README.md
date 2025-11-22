# RevolutMerchantApi

PHP client pro **Revolut Merchant API** s podporou **Nette DI** a **Tracy panelu**.

## Instalace

Pomocí Composeru:

```bash
composer require insightbase/RevolutMerchantApi-nette
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
