<?php

namespace Database;
class ServerDB
{
    private static $connections = [];

    /**
     * @param $configFileLocation
     *
     * @return \PDO
     * @throws \Exception
     */
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
        $options = [];
        $dsn = 'mysql:charset=utf8mb4;host=' . $connection['database']['hostname'] . ';dbname=' . $connection['database']['database'];
        $db = self::$connections[$configKey] = new \PDO($dsn, $connection['database']['username'], $connection['database']['password'], $options);
        $db->exec("set names utf8");
        return $db;
    }
}