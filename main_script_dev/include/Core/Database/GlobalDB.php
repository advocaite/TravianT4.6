<?php
namespace Core\Database;
class GlobalDB
{
    private static $_self;
    private static $lastConnect;

    /**
     * @return DB
     */
    public static function getInstance()
    {
        if (!(self::$_self instanceof DB)) {
            global $globalConfig;
            $databaseDetails = $globalConfig['dataSources']['globalDB'];
            self::$_self = new DB(FALSE);
            self::$_self->setDatabaseDetails([$databaseDetails['hostname'], $databaseDetails['username'], $databaseDetails['password'], $databaseDetails['database'], $databaseDetails['charset']]);
            self::$_self->reconnect();
            self::$lastConnect = time();
        }
        return self::$_self;
    }
    public static function getAConnection(){
        global $globalConfig;
        $databaseDetails = $globalConfig['dataSources']['globalDB'];
        $connection = new DB(FALSE);
        $connection->setDatabaseDetails([$databaseDetails['hostname'], $databaseDetails['username'], $databaseDetails['password'], $databaseDetails['database'], $databaseDetails['charset']]);
        $connection->reconnect();
        return $connection;
    }
}