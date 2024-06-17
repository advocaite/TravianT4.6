<?php
namespace Core;
use Core\Database\DB;
class Log
{
    public static function addLog($uid, $type, $info){
        DB::getInstance()->query("INSERT INTO `general_log`(`uid`, `type`, `log_info`, `time`) VALUES ($uid, '$type', '$info', ".time().")");
    }
}