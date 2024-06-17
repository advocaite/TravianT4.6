<?php
namespace Core;
class Config
{
    private static $_self;
    public static function &getInstance()
    {
        if (!is_object(self::$_self)) {
            self::$_self = include INCLUDE_PATH . 'config.php';
        }
        return self::$_self;
    }
    public static function getAdvancedProperty($property){
        return self::getProperty("settings", "advanced", $property);
    }
    public static function getProperty(){
        $args = func_get_args();
        $argsCount = func_num_args();
        $config = self::getInstance();
        if($argsCount == 2){
            return $config->{$args[0]}->{$args[1]};
        }
        for($i = 0; $i <= $argsCount - 1; ++$i){
            $config = $config->{$args[$i]};
        }
        return $config;
    }
}