<?php

namespace Core\Enums;
class ProviderEnum
{
    const ZARINPAL = 1;
    const PAYPAL = 2;
    const PAYGOL = 4;
    const ARIANPAL = 9;

    public static function toString($enum)
    {
        switch ($enum) {
            case self::ZARINPAL:
                return 'Zarinpal';
            case self::PAYPAL:
                return 'PayPal';
            case self::PAYGOL:
                return 'PayGol';
            case self::ARIANPAL:
                return 'Arianpal';
        }
        return 'Unknown';
    }
}