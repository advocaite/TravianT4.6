<?php
namespace Core\Database;
class ServerDB
{
    private static $connections = [];

    public static function getInstance($configFileLocation)
    {
        $configKey = substr(md5($configFileLocation), 0, 5);
        if (isset(self::$connections[$configKey])) {
            return self::$connections[$configKey];
        }
        if (!is_file($configFileLocation)) {
            throw new \Exception("Configuration file not found!");
        }
        require($configFileLocation);
        if (!isset($connection)) {
            throw new \Exception("Invalid data was in connection file!");
        }
        $db = self::$connections[$configKey] = new DB(FALSE);
        $db->doConnectManual($connection['database']['hostname'], $connection['database']['username'], $connection['database']['password'], $connection['database']['database'], $connection['database']['charset']);
        return $db;
    }
}