<?php
namespace Core;
class DB
{
    /** @var \mysqli */
    public $mysqli;
    private $lastPing;

    public function doConnectManual($hostname, $username, $password, $database, $charset = 'utf8')
    {
        $this->real_connect($hostname, $username, $password, $database, 3306, NULL);
        if ($this->mysqli->connect_error) {
            trigger_error("Failed to connect to mysql server thought socket.");
            echo 'Failed to connect to mysql server thought socket.';
            exit(1);
        }
        $this->set_charset($charset);
        $this->lastPing = time();
    }

    public function more_results()
    {
        return $this->mysqli->more_results();
    }

    public function multi_query($query)
    {
        $status = $this->mysqli->multi_query($query);
        while ($this->more_results() && $this->next_result()) {
        }
        return $status;
    }

    public function real_connect($host = NULL, $username = NULL, $passwd = NULL, $dbname = NULL, $port = NULL, $socket = NULL)
    {
        $this->mysqli = new \mysqli($host, $username, $passwd, $dbname, $port, $socket);
        $status = $this->mysqli->ping();
        if ($status) {
            $this->set_charset("utf8");
            $this->lastPing = time();
        }
        return $status;
    }

    public function set_charset($charset)
    {
        return $this->mysqli->set_charset($charset);
    }

    public function ping()
    {
        return $this->mysqli->ping();
    }

    public function connect($host, $user, $password, $database, $port, $socket)
    {
        $this->mysqli->connect($host, $user, $password, $database, $port, $socket);
        $this->lastPing = time();
    }

    public function next_result()
    {
        return $this->mysqli->next_result();
    }

    public function multi_query_non_wait($query)
    {
        $status = $this->mysqli->multi_query($query);
        return $status;
    }

    public function mysqli($host, $user, $password, $database, $port, $socket)
    {
        $this->mysqli->mysqli($host, $user, $password, $database, $port, $socket);
        $this->lastPing = time();
    }

    public function query($query, $resultmode = MYSQLI_STORE_RESULT)
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

    public function real_escape_string($escapestr)
    {
        return $this->mysqli->real_escape_string($escapestr);
    }

    public function set_opt($option, $value)
    {
        $this->mysqli->set_opt($option, $value);
    }

    public function close()
    {
        if (!($this->mysqli instanceof \mysqli)) {
            return;
        }
        $this->mysqli->close();
    }
}