<?php

namespace Core;

use Core\Caching\Caching;
use function getCustom;

class FarmlistTracker
{
    const IS_LOCKED = 'isLocked';
    const TTL = 3600;

    const START_TRY = 'startTry';
    const TRY_COUNT = 'tryCount';

    private static function getCache($key, $default = NULL)
    {
        $cache = Caching::getInstance();
        $key = self::fixKey($key);
        return $cache->exists($key) ? $cache->get($key) : $default;
    }

    private static function hasCache($key)
    {
        $cache = Caching::getInstance();
        $key = self::fixKey($key);
        return $cache->exists($key);
    }

    private static function removeCache($key)
    {
        $cache = Caching::getInstance();
        $key = self::fixKey($key);
        $cache->delete($key);
    }

    private static function setCache($key, $value, $ttl = self::TTL)
    {
        $cache = Caching::getInstance();
        if ($value === true) $value = 1;
        if ($value === false) $value = 0;
        $cache->set(self::fixKey($key), $value, $ttl);
    }

    private static function fixKey($key)
    {
        return Session::getInstance()->getPlayerId() . ":FL:" . $key;
    }


    public static function isLocked()
    {
        return (bool)self::getCache(self::IS_LOCKED, FALSE);
    }


    public static function lock()
    {
        self::setCache(self::IS_LOCKED, true);
    }


    public static function unlock()
    {
        self::removeCache(self::IS_LOCKED);
        self::removeCache(self::START_TRY);
        self::removeCache(self::TRY_COUNT);
    }

    public static function addTry()
    {
        if (getCustom("useCaptchaForFarmlistProtection")) {
            if (!(self::hasCache(self::START_TRY))) {
                self::setCache(self::START_TRY, time());
            }
            self::setCache(self::TRY_COUNT, (int)self::getCache(self::TRY_COUNT, 0) + 1);
            self::checkForExceedRate();
        }
    }

    private static function checkForExceedRate()
    {
        if (getCustom("useCaptchaForFarmlistProtection")) {
            $delay = mt_rand(
                Config::getProperty("game", "farmListInterval") - 5,
                Config::getProperty("game", "farmListInterval") + 5
            );
            $diffTime = time() - self::getCache(self::START_TRY, time());
            if ($diffTime < ($delay * 2)) return;
            $allowed = ceil($diffTime / $delay);
            $tryCount = (int)self::getCache(self::TRY_COUNT, 0);
            if ($tryCount >= $allowed) {
                self::lock();
            }
        }
    }

}