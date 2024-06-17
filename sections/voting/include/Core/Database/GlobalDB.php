<?php
namespace Core\Database;
class GlobalDB
{
    private static $_self;

    public static function getInstance()
    {
        if (!(self::$_self instanceof DB)) {
            global $globalConfig;
            $databaseDetails = $globalConfig['dataSources']['globalDB'];
            self::$_self = new DB();
            self::$_self->doConnectManual(
                $databaseDetails['hostname'],
                $databaseDetails['username'],
                $databaseDetails['password'],
                $databaseDetails['database'],
                $databaseDetails['charset']
            );
        }
        return self::$_self;
    }

    public static function getGameServer($worldUniqueId)
    {
        $worldUniqueId = (int)$worldUniqueId;
        $server = self::getInstance()->query("SELECT * FROM gameServers WHERE id=$worldUniqueId");
        if ($server->num_rows) {
            return $server->fetch_assoc();
        }
        return false;
    }
}