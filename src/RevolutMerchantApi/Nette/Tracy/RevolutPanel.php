<?php
namespace RevolutMerchantApi\Nette\Tracy;

use Tracy\IBarPanel;
use RevolutMerchantApi\Api\RevolutLogger;

class RevolutPanel implements IBarPanel
{
    public function __construct(
        private RevolutLogger $logger
    ) { }

    public function getTab(): string
    {
        $count = count($this->logger->logs);
        return "Revolut API ($count)";
    }

    public function getPanel(): string
    {
        ob_start();
        echo "<h1>Revolut Merchant API Logs</h1>";
        echo "<table style='width:100%; border-collapse: collapse'>";

        foreach ($this->logger->logs as $log) {
            echo "<tr><td style='border-bottom:1px solid #ccc;padding:8px'><b>{$log['time']}</b><br>
                {$log['method']} {$log['endpoint']}<br>
                Status: {$log['status']}<br>
                Payload: <pre>" . htmlspecialchars(json_encode($log['payload'], JSON_PRETTY_PRINT)) . "</pre>
                Response: <pre>" . htmlspecialchars(json_encode($log['response'], JSON_PRETTY_PRINT)) . "</pre>
            </td></tr>";
        }

        echo "</table>";
        return ob_get_clean();
    }
}
