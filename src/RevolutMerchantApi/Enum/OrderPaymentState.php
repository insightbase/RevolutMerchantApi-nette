<?php

namespace RevolutMerchantApi\Enum;

enum OrderPaymentState: string
{
    case PENDING = 'pending';
    case AUTHENTICATION_CHALLENGE = 'authentication_challenge';
    case AUTHENTICATION_VERIFIED = 'authentication_verified';
    case AUTHORISATION_STARTED = 'authorisation_started';
    case AUTHORISATION_PASSED = 'authorisation_passed';
    case AUTHORISED = 'authorised';
    case CAPTURE_STARTED = 'capture_started';
    case CAPTURED = 'captured';
    case REFUND_VALIDATED = 'refund_validated';
    case REFUND_STARTED = 'refund_started';
    case CANCELLATION_STARTED = 'cancellation_started';
    case DECLINING = 'declining';
    case COMPLETING = 'completing';
    case CANCELLING = 'cancelling';
    case FAILING = 'failing';
    case COMPLETED = 'completed';
    case DECLINED = 'declined';
    case SOFT_DECLINED = 'soft_declined';
    case CANCELLED = 'cancelled';
    case FAILED = 'failed';

    /**
     * Bezpečný try-from: vrací null nebo enum.
     */
    public static function try(string $state): ?self
    {
        return self::tryFrom($state);
    }

}
