<?php
namespace RevolutMerchantApi\Enum;

enum PaymentState: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';
}
