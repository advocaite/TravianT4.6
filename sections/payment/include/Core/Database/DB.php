<?php

namespace Core\Database;
use function var_dump;

class DB
{
    /** @var \mysqli */
    public $mysqli;

    public function doConnectManual($hostname, $username, $password, $database, $charset = 'utf8')
    {
        $result = $this->real_connect($hostname, $username, $password, $database);
        if (!$result) {
            echo 'Failed to connect to mysql server thought socket.';
            exit(1);
        }
        $this->set_charset($charset);
        $this->lastPing = time();
    }

    public function close()
    {
        if (!($this->mysqli instanceof \mysqli)) {
            return;
        }
        $this->mysqli->close();
    }

    /**
     * @param $query
     * @param int $resultmode
     * @param bool $useCache
     * @return \mysqli_result
     */
    public function query($query, $resultmode = MYSQLI_STORE_RESULT, $useCache = true)
    {
        $status = $this->mysqli->query($query, $resultmode);
        if (!empty($this->mysqli->error)) {
            trigger_error("Mysqli Error: " . $this->mysqli->error . ' in Query: ' . $query, E_USER_WARNING);
        }
        return $status;
    }

    public function lastInsertId()
    {
        return $this->mysqli->insert_id;
    }

    public function affectedRows()
    {
        return $this->mysqli->affected_rows;
    }

    public function real_connect($host = null, $username = null, $passwd = null, $dbname = null, $port = null, $socket = null)
    {
        $this->mysqli = new \mysqli($host, $username, $passwd, $dbname, $port, $socket);
        $status = $this->mysqli->ping();
        if ($status) {
            $this->set_charset("utf8");
        }
        return $status;
    }

    public function real_escape_string($escapestr)
    {
        return $this->mysqli->real_escape_string($escapestr);
    }

    public function set_charset($charset)
    {
        return $this->mysqli->set_charset($charset);
    }

    public function __destruct()
    {
        $this->close();
    }
}