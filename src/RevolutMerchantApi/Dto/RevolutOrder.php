<?php
namespace RevolutMerchantApi\Dto;

use RevolutMerchantApi\Enum\CaptureMode;
use RevolutMerchantApi\Enum\ChallengeMode;

class RevolutOrder
{
    private array $data = [];

    public function setAmount(float $amount): self
    {
        // minor units (e.g. 50.25 -> 5025)
        $this->data['amount'] = (int) round($amount * 100);
        return $this;
    }

    public function setCurrency(string $currency): self
    {
        $this->data['currency'] = strtoupper($currency);
        return $this;
    }

    public function setCaptureMode(CaptureMode $mode): self
    {
        $this->data['capture_mode'] = $mode->value;
        return $this;
    }

    public function setEnforceChallenge(ChallengeMode $mode): self
    {
        $this->data['enforce_challenge'] = $mode->value;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->data['description'] = $description;
        return $this;
    }

    public function setCustomerEmail(string $email): self
    {
        $this->data['customer_email'] = $email;
        return $this;
    }

    public function setMetadata(array $metadata): self
    {
        $this->data['metadata'] = $metadata;
        return $this;
    }

    public function addField(string $key, mixed $value): self
    {
        $this->data[$key] = $value;
        return $this;
    }

    public function toArray(): array
    {
        return $this->data;
    }
}
