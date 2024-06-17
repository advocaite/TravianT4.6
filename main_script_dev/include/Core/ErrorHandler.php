<?php

namespace Core;

use const ERROR_LOG_FILE;
use const IS_DEV;
use function json_encode;
use function restore_exception_handler;

class ErrorHandler
{
    private static $instance;
    private $isCLI = false;

    public function __construct()
    {
        error_reporting(E_ALL & ~E_NOTICE | E_STRICT);
        ini_set('display_errors', IS_DEV);
        set_error_handler([$this, 'handleErrors']);
        register_shutdown_function([$this, 'handleFatalErrors']);
        $this->isCLI = php_sapi_name() == 'cli';
        if ($this->isCLI) {
            set_exception_handler([$this, 'handleExceptions']);
        }
    }

    public function setAsCGI()
    {
        if ($this->isCLI) {
            restore_exception_handler();
            $this->isCLI = false;
        }
    }

    public static function getInstance()
    {
        if (!(self::$instance instanceof ErrorHandler)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function log($message)
    {
        if (is_array($message)) {
            $message = json_encode($message);
        }
        if (is_writable($this->getErrorLogsLocation())) {
            file_put_contents($this->getErrorLogsLocation(), '[' . date("Y.m.d H:i:s") . '] ' . $message . PHP_EOL, FILE_APPEND);
        }
    }

    public function handleExceptions($e)
    {
        if ($e instanceof \Exception) {
            $this->log($e->getMessage());
        } else if ($e instanceof \Error) {
            $this->log($e->getMessage());
        }
        return TRUE;
    }

    public function handleFatalErrors()
    {
        $error = error_get_last();
        if ($error["type"] == E_ERROR) {
            $this->handleErrors($error["type"], $error["message"], $error["file"], $error["line"]);
        }
    }

    public function handleErrors($errNumber, $errMessage, $errFile, $errLine)
    {
        switch ($errNumber) {
            case E_WARNING      :
            case E_USER_WARNING :
            case E_STRICT       :
            case E_NOTICE       :
            case E_USER_NOTICE  :
                $type = 'warning';
                break;
            default             :
                $type = 'fatal error';
                break;
        }
        $trace = array_reverse(debug_backtrace());
        array_pop($trace);
        $items = [];
        foreach ($trace as $item) {
            $items[] = (isset($item['file']) ? $item['file'] : '<unknown file>') . ' ' . (isset($item['line']) ? $item['line'] : '<unknown line>') . ' calling ' . (isset($item['function']) ? $item['function'] : 'unknown') . '()';
        }
        $errString = 'Backtrace from ' . $type . ' \'' . $errMessage . '\' at ' . $errFile . ' ' . $errLine . ': ' . join(' | ',
                $items);
        $this->log($errString);
        if ($this->isCLI) {
            throw new \ErrorException($errString, 0, $errNumber, $errFile, $errLine);
        }
        return TRUE;
    }

    private function getErrorLogsLocation()
    {
        return ERROR_LOG_FILE;
    }
}
