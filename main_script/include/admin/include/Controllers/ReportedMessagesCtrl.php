<?php

use Core\Database\DB;
use Core\Helper\BBCode;
use Core\Helper\TimezoneHelper;
use Model\MessageModel;

class ReportedMessagesCtrl
{
    public function __construct()
    {
        if (isset($_REQUEST['see'])) {
            $this->processAnswer();
        } else if (isset($_REQUEST['delete'])) {
            $this->deleteTicket(1);
        } else if (isset($_REQUEST['deleteAll'])) {
            $this->deleteTicket(2);
        } else {
            $this->showTickets();
        }
    }

    private function deleteTicket($type)
    {
        if($type == 2){
            $answerId = (int)$_REQUEST['deleteAll'];
            $db = DB::getInstance();
            $db->query("UPDATE mdata SET delete_receiver=1, delete_sender=1 WHERE uid={$answerId}");
            $db->query("DELETE FROM messages_report WHERE reported_uid=$answerId");
        } else {
            $db = DB::getInstance();
            $answerId = (int)$_REQUEST['delete'];
            $db->query("DELETE FROM messages_report WHERE id=$answerId");
        }
        $this->showTickets();
    }

    private function processAnswer()
    {
        $answerId = (int)$_REQUEST['see'];
        $ticket = DB::getInstance()->query("SELECT * FROM messages_report WHERE id=$answerId");
        if (!$ticket->num_rows) {
            $this->showTickets();
            return;
        }
        $msgModel = new MessageModel();
        $ticket = $ticket->fetch_assoc();
        $params['error'] = '';
        $params['answerId'] = $answerId;
        $params['player'] = '<a href="admin.php?action=editPlayer&uid=' . $ticket['reported_uid'] . '">' . $msgModel->getPlayerName($ticket['reported_uid']) . '</a>';
        $params['subject'] = $ticket['time'];
        $params['time'] = $ticket['time'];
        $msgR = $msgModel->getMessageAdmin($ticket['message_id']);
        $params['message'] = BBCode::translateMessagesBBCode($msgR['message']);
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/reportShow.tpl')->getAsString());
    }
    private function getPlayerName($uid)
    {
        $db = DB::getInstance();
        $find = $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
        if ($find)
            return $find;
        return 'n/a';
    }
    private function showTickets()
    {
        $params['content'] = '';
        $params['error'] = '';
        $messages = new MessageModel();
        $db = DB::getInstance();
        $result = $db->query("SELECT * FROM messages_report ORDER BY id ASC LIMIT 20");
        while ($row = $result->fetch_assoc()) {
            $params['content'] .= '<tr>';
            $params['content'] .= '<td>' . $row['id'] . '.</td>';
            $params['content'] .= '<td><a href="admin.php?action=editPlayer&uid=' . $row['reported_uid'] . '">' . $messages->getPlayerName($row['reported_uid']) . '</a></td>';
            $params['content'] .= '<td><a href="admin.php?action=reportedMessages&see=' . $row['id'] . '">' . $row['type'] . '</a></td>';
            $params['content'] .= '<td>' . TimezoneHelper::autoDateString($row['time'], true) . '</td>';
            $params['content'] .= '<td style="text-align: center;"><a href="admin.php?action=reportedMessages&delete=' . $row['id'] . '"><img src="img/x.gif" class="del"></a>|<a href="admin.php?action=reportedMessages&deleteAll='.$row['reported_uid'].'">Delete all messages</a></td>';
            $params['content'] .= '</tr>';
        }
        if (!$result->num_rows) {
            $params['content'] = '<tr><td colspan="5" style="text-align: center; color: #C0C0C0">No tickets!</td></tr>';
        }
        $dispatcher = Dispatcher::getInstance();
        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/reportedMessages.tpl')->getAsString());
    }
}