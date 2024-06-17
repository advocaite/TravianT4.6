<?php

namespace Core\Database;

use function array_key_exists;
use Core\Config;
use PDO;

/**
 * Class DBI
 * @package Core\Database
 * @method  lastInsertId($name = null)
 */
class DBI
{
    private        $pdo;
    private static $instances = [];
    private        $conn;

    /**
     * DBI constructor.
     * @param $conn
     * @param $hostname
     * @param $username
     * @param $password
     * @param $database
     * @param string $charset
     */
    private function __construct($conn, $hostname, $username, $password, $database, $charset = 'utf8mb4')
    {
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => FALSE,
        ];

        $this->conn = $conn;
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', $hostname, $database, $charset);
        $this->pdo = new PDO($dsn, $username, $password, $opt);
    }

    /**
     * @param string $conn
     * @param null $dbDetails
     * @return DBI
     */
    public static function getInstance($conn = 'default', $dbDetails = null)
    {
        if (is_null($dbDetails))
            $dbDetails = (array)Config::getInstance()->db;
        if (!array_key_exists($conn, self::$instances))
            self::$instances[$conn] = new self(
                $conn,
                $dbDetails['hostname'],
                $dbDetails['username'],
                $dbDetails['password'],
                $dbDetails['database']
            );
        return self::$instances[$conn];
    }

    public function run($sql, $args = NULL)
    {
        if ($args === null) return $this->pdo->query($sql);
        if (!is_array($args)) $args = [$args];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public function fetchSingleRow($sql, $args = null, $default = false, $fetch_style = PDO::FETCH_ASSOC)
    {
        $stmt = $this->run($sql, $args);
        if (!$stmt->rowCount()) {
            return $default;
        }
        return $stmt->fetch($fetch_style);
    }

    public function fetchScalar($sql, $args = null, $default = false)
    {
        $stmt = $this->run($sql, $args);
        if (!$stmt->rowCount()) {
            return $default;
        }
        return $stmt->fetchColumn();
    }

    public function fetchPluck($sql, $args = null, $column = null)
    {
        $stmt = $this->run($sql, $args);
        $result = [];
        if (!is_null($column))
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (isset($row[$column]))
                    $result[] = $row[$column];
            }
        else
            $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $result;
    }

    public function __call($method, $args)
    {
        return call_user_func_array(array($this->pdo, $method), $args);
    }

    public function disconnect()
    {
        self::$instances[$this->conn] = null;
        $this->pdo = null;
    }
}