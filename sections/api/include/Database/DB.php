<?php

namespace Database;

use PDO;

class DB extends PDO
{
    private static $instance;

    public function __construct()
    {
        global $globalConfig;
        $db = [
            'host' => $globalConfig['dataSources']['globalDB']['hostname'],
            'user' => $globalConfig['dataSources']['globalDB']['username'],
            'pass' => $globalConfig['dataSources']['globalDB']['password'],
            'name' => $globalConfig['dataSources']['globalDB']['database'],
            'charset' => $globalConfig['dataSources']['globalDB']['charset'],
        ];
        $options = [];
        $dsn = 'mysql:charset=utf8mb4;host=' . $db['host'] . ';dbname=' . $db['name'];
        parent::__construct($dsn, $db['user'], $db['pass'], $options);
        $this->exec("set names utf8mb4");
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}