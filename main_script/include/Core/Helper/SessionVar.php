<?php

namespace Core\Helper;
class SessionVar
{
    public static function getVariable($name, $default, $timeout = 0)
    {
        if (!isset($_SESSION[WebService::fixSessionPrefix($name)])) {
            $_SESSION[WebService::fixSessionPrefix($name)] = $default;
            $_SESSION[WebService::fixSessionPrefix($name . '_time')] = time();
        }
        if ($timeout) {
            if (time() - $_SESSION[WebService::fixSessionPrefix($name . '_time')] > $timeout) {
                $_SESSION[WebService::fixSessionPrefix($name)] = $default;
                $_SESSION[WebService::fixSessionPrefix($name . '_time')] = time();
            }
        }
        return $_SESSION[WebService::fixSessionPrefix($name)];
    }

    public static function getElapsedTimes($name)
    {
        if (isset($_SESSION[WebService::fixSessionPrefix($name . '_time')])) {
            return time() - $_SESSION[WebService::fixSessionPrefix($name . '_time')];
        }
        return 0;
    }

    public static function timeoutNow($name)
    {
        unset($_SESSION[WebService::fixSessionPrefix($name)]);
        unset($_SESSION[WebService::fixSessionPrefix($name . '_time')]);
    }

    public static function setVariable($name, $value, $update = true)
    {
        $_SESSION[WebService::fixSessionPrefix($name)] = $value;
        if ($update) {
            $_SESSION[WebService::fixSessionPrefix($name . '_time')] = time();
        }
    }
}