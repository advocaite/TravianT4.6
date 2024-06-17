<?php

use Core\Database\DB;
use Core\Helper\WebService;
use Core\Session;
use Model\InfoBoxModel;

class DeleteAllMessagesCtrl
{
    public function __construct()
    {
        $params['id'] = isset($_POST['id']) ? (int)$_POST['id'] : null;
        $params['result'] = false;
        if (WebService::isPost() && Session::validateChecker()) {
            $db = DB::getInstance();
            $db->query("UPDATE mdata SET delete_receiver=1, delete_sender=1 WHERE uid={$params['id']}");
            $db->query("DELETE FROM messages_report WHERE reported_uid={$params['id']}");
            $this->banPlayer($params['id']);
            $params['result'] = true;
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/deleteAllMessages.tpl')->getAsString());
    }

    private function banPlayer($uid)
    {
        $reason = 'Spam';
        $time = 7200;
        $db = DB::getInstance();
        $exists = 0 < $db->fetchScalar("SELECT COUNT(id) FROM banQueue WHERE uid=$uid");
        if (!$exists) {
            $db->query("UPDATE users SET access=0 WHERE id=$uid");
            if ($db->affectedRows()) {
                $db->query("INSERT INTO `banQueue`(`uid`, `reason`, `time`, `end`) VALUES ($uid, '$reason', " . time() . ", " . ($time == 0 ? $time : $time + time()) . ")");
                $db->query("INSERT INTO `banHistory`(`uid`, `reason`, `time`, `end`) VALUES ($uid, '$reason', " . time() . ", " . ($time == 0 ? $time : $time + time()) . ")");
                $db->query("DELETE FROM multiaccount_users WHERE uid=$uid");
                (new InfoBoxModel())->addInfo($uid, 0, 14, '', time(), time() + 365 * 86400);
            }
        }
    }
}