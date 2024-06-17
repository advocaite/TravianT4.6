<?php

namespace Core\Database;

use Core\Config;
use Core\ErrorHandler;
use const BACKUP_PATH;
use function logError;
use function miliseconds;

class DB
{
    /** @var \mysqli */
    public $mysqli;
    private $lastPing;
    private static $_self;
    private $details;

    public function setDatabaseDetails($details)
    {
        $this->details = $details;
    }

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
        }
        return self::$_self;
    }

    public function __construct($connect = true)
    {
        if (!$this->isCLI()) {
            if ($connect) {
                $this->doConnect();
            }
        }
    }

    public function isCLI()
    {
        return php_sapi_name() == 'cli' && !defined("IS_INSTALLER");
    }

    public function doConnect()
    {
        $config = Config::getInstance();
        $this->details = [
            $config->db->hostname,
            $config->db->username,
            $config->db->password,
            $config->db->database,
            $config->db->charset,
        ];
        if ($this->isCLI()) {
            $this->real_connect("p:" . $this->details[0],
                $this->details[1],
                $this->details[2],
                $this->details[3],
                3306,
                NULL);
        } else {
            $this->real_connect($this->details[0], $this->details[1], $this->details[2], $this->details[3], 3306, NULL);
        }
        if ($this->mysqli->connect_error) {
            trigger_error("Failed to connect to mysql server thought socket.");
            echo 'Failed to connect to mysql server thought socket.';
            exit(1);
        }
        $this->set_charset($this->details[4]);
        $this->lastPing = time();
    }

    public function reconnect()
    {
        if (!$this->details) {
            $config = Config::getInstance();
            $this->details = [
                $config->db->hostname,
                $config->db->username,
                $config->db->password,
                $config->db->database,
                $config->db->charset,
            ];
        }
        if ($this->isCLI()) {
            $this->real_connect("p:" . $this->details[0],
                $this->details[1],
                $this->details[2],
                $this->details[3],
                3306,
                NULL);
        } else {
            $this->real_connect($this->details[0], $this->details[1], $this->details[2], $this->details[3], 3306, NULL);
        }
        if ($this->mysqli->connect_error) {
            trigger_error("Failed to connect to mysql server thought socket.");
            echo 'Failed to connect to mysql server thought socket.';
            exit(1);
        }
        $this->set_charset($this->details[4]);
        $this->lastPing = time();
    }

    public function forceNewDatabase()
    {
        $this->reconnect();
        return DB::getInstance();
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

    public function checkConnection($force = false)
    {
        if (!($this->mysqli instanceof \mysqli)) {
            $this->forceNewDatabase();
            sleep(2);
        }
        $ping = TRUE;
        if (($this->lastPing - time()) > 100 || $force) {
            $ping = $this->ping();
            $try = 0;
            while (!$ping && $try <= 20) {
                ++$try;
                $this->forceNewDatabase();
                $ping = $this->ping();
                logError("Could not ping MySQL");
                sleep(1);
            }
            if ($ping) $this->lastPing = time();
        }
        return $ping;
    }

    public function connect($host, $user, $password, $database, $port, $socket)
    {
        $this->mysqli->connect($host, $user, $password, $database, $port, $socket);
        $this->lastPing = time();
    }

    public function begin_transaction()
    {
        return $this->mysqli->begin_transaction();
    }

    public function commit()
    {
        return $this->mysqli->commit();
    }

    public function rollback()
    {
        return $this->mysqli->rollback();
    }

    public function next_result()
    {
        return $this->mysqli->next_result();
    }

    public function query($query, $resultmode = MYSQLI_STORE_RESULT)
    {
        if ($this->isCLI() && !$this->checkConnection()) {
            trigger_error("GONE AWAY | Mysqli Error: " . $this->mysqli->error . ' in Query: ' . $query, E_USER_WARNING);
            return false;
        }
        $status = $this->mysqli->query($query, $resultmode);
        if (!empty($this->mysqli->error)) {
            trigger_error("Mysqli Error: " . $this->mysqli->error . ' in Query: ' . $query, E_USER_WARNING);
        }
        return $status;
    }

    public function fetchScalar($query, $parameters = [], $default = false)
    {
        $stmt = $this->query($query);
        if ($stmt && $stmt->num_rows) {
            return $stmt->fetch_row()[0];
        }
        return $default;
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

    public function close()
    {
        if (!($this->mysqli instanceof \mysqli)) {
            return;
        }
        $this->mysqli->close();
    }

    public function backup_tables($gameFinished = false)
    {
        DB::getInstance()->query("UPDATE config SET lastBackup=" . time());
        $files = glob(BACKUP_PATH . "/*");
        $now = time();
        foreach ($files as $file) {
            if (is_file($file)) {
                $fileTime = floor((int)explode("-", basename($file))[1] / 1000);
                if (($now - $fileTime) >= ($gameFinished ? 2 : 12) * 3600) { // 2 days
                    unlink($file);
                }
            }
        }
        $filename = BACKUP_PATH . '/backup-' . miliseconds() . '.sql';
        $databaseName = escapeshellarg($this->details[3]);
        $arguments = [
            '--host=' . escapeshellarg($this->details[0]),
            '--user=' . escapeshellarg($this->details[1]),
            '--password=' . escapeshellarg($this->details[2]),
            '--skip-set-charset',
            '--add-drop-database',
            '--default-character-set=utf8mb4',
            '--single-transaction',
            "--ignore-table={$databaseName}.marks",
            "--ignore-table={$databaseName}.blocks",
            "--ignore-table={$databaseName}.surrounding",
            "--ignore-table={$databaseName}.map_block",
            "--ignore-table={$databaseName}.map_mark",
            "--ignore-table={$databaseName}.general_log",
            "--ignore-table={$databaseName}.admin_log",
            "--ignore-table={$databaseName}.a2b",
            escapeshellarg($this->details[3]),
        ];
        exec('mysqldump ' . implode(" ", $arguments) . ' | gzip --best > ' . $filename, $output);
    }
}