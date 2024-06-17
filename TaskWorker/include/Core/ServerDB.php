<?php

namespace Core;
class ServerDB
{
    private static $connections = [];

    public static function newConnection($configFileLocation)
    {
        $configKey = substr(md5($configFileLocation), 0, 5);
        if (!is_file($configFileLocation)) {
            throw new \Exception("Configuration file not found!");
        }
        require($configFileLocation);
        if (!isset($connection)) {
            throw new \Exception("Invalid data was in connection file!");
        }
        $db = self::$connections[$configKey] = new DB();
        $db->doConnectManual($connection['database']['hostname'], $connection['database']['username'], $connection['database']['password'], $connection['database']['database'], $connection['database']['charset']);
        return $db;
    }
}