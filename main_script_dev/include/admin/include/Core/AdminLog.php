<?php

use Core\Database\DB;
use Core\Helper\WebService;
use Core\Session;

class AdminLog
{
    private static $_self;

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
        }
        return self::$_self;
    }

    private $session;

    public function __construct()
    {
        $this->session = Session::getInstance();
    }

    public function addLog($text)
    {
        $ip = WebService::ipAddress();
        if($this->session->isValid()){
            $text = '[' . $this->session->getName() . '(' . $this->session->getAdminUid() . ')' . '] => ' . $text;
            $db = DB::getInstance();
            $db->query("INSERT INTO `admin_log`(`log`, `ip`, `time`) VALUES ('$text', '$ip', ".time().")");
        } else {
            $db = DB::getInstance();
            $db->query("INSERT INTO `admin_log`(`log`, `ip`, `time`) VALUES ('$text', '$ip', ".time().")");
        }
    }

    public function getLastLogs($count = 20)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM admin_log ORDER BY id DESC LIMIT $count");
    }
}