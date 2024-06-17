<?php
namespace Core\Caching;
class GlobalCaching extends Caching
{
    public static function singleton($key = null)
    {
        return parent::singleton(trim(GLOBAL_CACHING_KEY . ':'));
    }
}