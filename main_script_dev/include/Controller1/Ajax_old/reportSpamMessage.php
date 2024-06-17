<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Helper\Notification;
use Core\Session;
use Core\Locale;
use Model\MessageModel;

class reportSpamMessage extends AjaxBase
{
    public function dispatch()
    {
        $messageId = (int)$_POST['messageId'];
        $spamReason = in_array($_POST['spamReason'],
            ['advertisement', 'harassment', 'gold', 'misc',]) ? $_POST['spamReason'] : FALSE;
        if ($spamReason === FALSE) {
            return;
        }
        $m = new MessageModel();
        $message = $m->getMyMessage($messageId, Session::getInstance()->getPlayerId());
        $send = $message['uid'] == Session::getInstance()->getPlayerId();
        if ($send) {
            // My Own
            return;
        }
        $uid = $message['uid'];
        if ($message === false) {
            $this->response['error'] = true;
            $this->response['errorMsg'] = 'Message not found.';
            return;
        }
        if ($message['reported']) {
            $this->response['error'] = true;
            $this->response['errorMsg'] = 'Message already reported.';
            return;
        }
        if ($message['autoType']) {
            $this->response['error'] = true;
            $this->response['errorMsg'] = 'This type of message cannot be reported.';
            return;
        }
        if ($uid == Session::getInstance()->getPlayerId()) {
            $this->response['error'] = true;
            $this->response['errorMsg'] = 'You cannot report yourself.';
            return;
        }
        $m->setMessageAsReported($messageId,
            array_search($_POST['spamReason'], ['advertisement', 'harassment', 'gold', 'misc']) + 1);
        if (empty($message['message'])) {
            $message['message'] = 'EMPTY Message reported!';
        }
        $this->response['data']['reportingSuccessful'] = T("Messages", "reportingSuccessful");
        $this->response['data']['closeButtonText'] = T("Messages", "closeButtonText");
        Notification::notify("Spam message reported",
            "A message has been reported as $spamReason from player [UID=$uid].");
        $db = DB::getInstance();
        $db->query(sprintf("INSERT INTO `messages_report`(`uid`, `reported_uid`, `message_id`, `type`, `time`) VALUES ('%s', '%s', '%s', '%s', '%s')",
            Session::getInstance()->getPlayerId(),
            $message['uid'],
            $message['id'],
            $spamReason,
            time()));
    }
}