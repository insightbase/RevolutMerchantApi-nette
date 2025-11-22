<?php
namespace RevolutMerchantApi\Enum;

enum CaptureMode: string
{
    case AUTOMATIC = 'automatic';
    case MANUAL = 'manual';
}
