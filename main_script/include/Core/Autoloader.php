<?php
namespace Core;
class Autoloder
{
    public static function register($prepend = FALSE)
    {
        if(version_compare(phpversion(), '5.3.0', '>=')) {
            spl_autoload_register([__CLASS__, 'autoload'], TRUE, $prepend);
        } else {
            spl_autoload_register([__CLASS__, 'autoload']);
        }
    }

    public static function autoload($className)
    {
        if(class_exists($className)) {
            return TRUE;
        }
        $fullpath = self::getFullPath($className);
        if(is_file($fullpath)) {
            require($fullpath);
        } else {
            return false;
        }
        return TRUE;
    }

    public static function getFullPath($className)
    {
        return ROOT_PATH."include".DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $className).'.php';
    }
}
Autoloder::register();
ErrorHandler::getInstance();
