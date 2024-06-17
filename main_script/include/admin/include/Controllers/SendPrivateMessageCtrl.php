<?php

use Core\Config;
use Core\Database\DB;
use Core\Helper\WebService;

class SendPrivateMessageCtrl
{
    public function __construct()
    {
        $dispatcher = Dispatcher::getInstance();
        if (WebService::isPost() && !empty($_POST['message'])) {
            $db = DB::getInstance();
            $db->query("UPDATE config SET message='".$db->real_escape_string($_POST['message'])."'");
            $db->query("UPDATE users SET ok=1");
            AdminLog::getInstance()->addLog("Sent a private message!");
            Config::getInstance()->dynamic->message = $_POST['message'];
        }
        $dispatcher->appendContent(Template::getInstance()->load(['message' => Config::getInstance()->dynamic->message], 'tpl/privateMessage.tpl')->getAsString());
    }
}