<?php
namespace RevolutMerchantApi\Enum;

enum ChallengeMode: string
{
    case AUTOMATIC = 'automatic';
    case ALWAYS = 'always';
    case NEVER = 'never';
}
