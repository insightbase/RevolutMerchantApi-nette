<?php
namespace RevolutMerchantApi\Nette;

use Nette\DI\CompilerExtension;
use RevolutMerchantApi\Api\RevolutHttpClient;
use RevolutMerchantApi\Api\RevolutLogger;
use RevolutMerchantApi\Api\RevolutApi;
use RevolutMerchantApi\Nette\Tracy\RevolutPanel;
use Tracy\Debugger;

class RevolutMerchantApiExtension extends CompilerExtension
{
    private array $defaults = [
        'apiKey' => null,
        'apiUrl' => 'https://merchant.revolut.com/api',
        'debug' => false,
    ];

    public function loadConfiguration()
    {
        $config = $this->validateConfig($this->defaults);

        $builder = $this->getContainerBuilder();

        $builder->addDefinition($this->prefix('logger'))
            ->setFactory(RevolutLogger::class);

        $builder->addDefinition($this->prefix('client'))
            ->setFactory(RevolutHttpClient::class, [
                $config['apiKey'],
                $config['apiUrl'],
                $builder->getDefinition($this->prefix('logger'))
            ]);

        $builder->addDefinition($this->prefix('api'))
            ->setFactory(RevolutApi::class);
    }

    public function afterCompile(\Nette\PhpGenerator\ClassType $class)
    {
        $config = $this->getConfig();
        if (!($config['debug'] ?? false)) { return; }

        //$initialize = $class->methods['initialize'];
        //$initialize->addBody('Tracy\Debugger::getBar()->addPanel(new \' . RevolutPanel::class . '($this->getService(?));', [$this->prefix('logger')]);
    }
}
