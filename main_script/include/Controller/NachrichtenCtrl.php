<?php

namespace Controller;

use Core\Config;
use Core\Database\DB;
use Core\Helper\BBCode;
use Core\Helper\Notification;
use Core\Helper\PageNavigator;
use Core\Helper\StringChecker;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Model\AllianceModel;
use Model\InfoBoxModel;
use Model\MessageModel;
use Model\Quest;
use Model\TransferGoldModel;
use resources\View\GameView;
use resources\View\PHPBatchView;
use const PHP_EOL;
use function getDisplay;
use Core\Caching\Caching;

class NachrichtenCtrl extends GameCtrl
{
    private function getSubject($autoType, $subject)
    {
        if ($autoType) {
            switch ($autoType) {
                case 1:
                case 2:
                    $subject = T("Messages",
                        $autoType == 1 ? "Alliance Invitation received" : "Alliance Invitation revoked");
                    break;
                case 3:
                    return T("inGame", "QUEST_MESSAGE_SUBJECT");
                case 4:
                    return '<span style="color: darkgoldenrod">' . T("Global", "FreeGoldTitle") . '</span>';
                case 5:
                    $translation = [
                        'topAttacker' => T("Statistics", "top10.attackers of the week"),
                        'topDefender' => T("Statistics", "top10.defenders of the week"),
                        'topClimber' => T("Statistics", "top10.climbers of the week"),
                        'topRaider' => T("Statistics", "top10.robbers of the week"),
                    ];
                    return '<span style="color: darkgoldenrod">' . $translation[$subject] . '</span>';
                case 6:
                    return '<span style="color: darkgoldenrod">' . T("TransferGold", "TransferMsg.Subject") . '</span>';

            }
        }

        return $subject;
    }

    private function getMessageText($autoType, $subject, $message)
    {
        if ($autoType) {
            switch ($autoType) {
                case 1:
                case 2:
                    $data = unserialize($message);
                    return BBCode::translateMessagesBBCode(vsprintf(T("Messages", $autoType == 1 ? "AllianceInvitationReceiveText" : "AllianceInvitationRevokeText"), $data));
                case 3:
                    return sprintf(T("inGame", "QUEST_MESSAGE"), Session::getInstance()->getName());
                case 4:
                case 5:
                    return sprintf(nl2br(T("Global", "FreeGold")), $message);
                case 6:
                    $data = unserialize($message);
                    $m = new TransferGoldModel();
                    $log = $m->getLog($data['logId']);
                    $fromPlayer = '?';
                    if($log){
                        $fromPlayer = $m->getPlayerName($log['uid']);
                    }
                    return vsprintf(nl2br(T("TransferGold", "TransferMsg.Message")), [
                        $this->session->getName(),
                        $data['amount'],
                        $fromPlayer,
                    ]);
                    break;
            }
        }
        return nl2br(BBCode::translateMessagesBBCode($message));
    }

    public function __construct()
    {
        parent::__construct();
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = T("Messages", "Messages");
        $this->view->vars['bodyCssClass'] = 'perspectiveBuildings';
        $this->view->vars['contentCssClass'] = 'messages';
        $selectedTab = isset($_REQUEST['t']) && $_REQUEST['t'] <= 5 && $_REQUEST['t'] >= 0 ? (int)$_REQUEST['t'] : Session::getInstance()->getFavoriteTab("messages");
        if ($selectedTab == 3 && !Session::getInstance()->hasGoldClub()) {
            $selectedTab = 1;
        }
        if (isset($_POST['toggleState']) && isset($_POST['id'])) {
            $hasPermission = Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_REMOVE_ARCHIVE_MESSAGES_OR_REPORTS);
            if ($hasPermission) {
                $m = new MessageModel();
                $msg = $m->getMessage((int)$_POST['id'], Session::getInstance()->getPlayerId());
                if (is_array($msg)) {
                    $m->setMessageAsUnViewed((int)$_POST['id'], Session::getInstance()->getPlayerId());
                    $selectedTab = 0;
                }
            }
        }
        $view = new PHPBatchView("messages/menu");
        $view->vars['favorText'] = sprintf(T("Global", "Select tab %s as favourite"), T("Messages", ['Inbox', 'Write', 'Sent', 'Archive', 'Notes', 'Ignored players'][$selectedTab]));
        $view->vars['Inbox'] = get_button_id();
        $view->vars['Write'] = get_button_id();
        $view->vars['Sent'] = get_button_id();
        $view->vars['selectedTab'] = $selectedTab;
        $view->vars['Archive'] = get_button_id();
        $view->vars['Notes'] = get_button_id();
        $view->vars['goldClub'] = Session::getInstance()->hasGoldClub();
        $view->vars['ArchiveGoldClubTitle'] = T("Messages", "Archive") . '||' . T("Messages", "needClub");
        $view->vars['ignoredPlayers'] = get_button_id();
        $this->view->vars['content'] .= $view->output();
        if (!isset($_REQUEST['toggleState']) && ($selectedTab == 0 || $selectedTab == 2 || $selectedTab == 3) && isset($_REQUEST['id']) && Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_SEND_OR_ANSWER_MESSAGES)) {
            $m = new MessageModel();
            $message = $m->getMessage((int)$_REQUEST['id'], Session::getInstance()->getPlayerId());
            if ($message !== FALSE) {
                $view = new PHPBatchView("messages/showMsg");
                $view->vars['answerActive'] = TRUE;
                if ($message['autoType']) {
                    $view->vars['answerActive'] = FALSE;
                }
                if ($message['reported']) {
                    $view->vars['reportedText'] = sprintf(T("Messages",
                        "Current message has already been reported as: x"),
                        [
                            T("Messages", "Advertisement"),
                            T("Messages", "harassment"),
                            T("Messages", "gold"),
                            T("Messages", "Other"),
                        ][$message['reported'] - 1]);
                }
                $view->vars['id'] = $message['id'];
                $view->vars['t'] = $selectedTab;
                $view->vars['time'] = TimezoneHelper::autoDateString($message['time'], TRUE);
                $view->vars['subject'] = $this->getSubject($message['autoType'], $message['topic']);
                $view->vars['send'] = $selectedTab == 2 || $message['to_uid'] != Session::getInstance()->getPlayerId();
                $view->vars['uid'] = $view->vars['send'] ? $message['to_uid'] : $message['uid'];
                $view->vars['isAdmin'] = Session::getInstance()->isAdmin();
                if ($view->vars['isAdmin']) {
                    if ($message['autoType'] && $message['autoType'] <= 2) {
                        $name = T("Messages", "Ambassador");
                    } else {
                        $name = $m->getPlayerName($message['uid']);
                    }
                    $view->vars['info'] = [
                        'name' => $name,
                        'uid' => $message['uid'],
                        'to_uid' => $message['to_uid'],
                        'to_name' => $m->getPlayerName($message['to_uid']),
                    ];
                }
                BBCode::setFromPlayer($message['uid']);
                if (Session::getInstance()->getPlayerId() == $message['to_uid']) {
                    BBCode::setToPlayer($message['to_uid']);
                }
                $view->vars['message'] = $this->getMessageText($message['autoType'], $message['topic'], $message['message']);
                $view->vars['reportable'] = $view->vars['uid'] != Session::getInstance()->getPlayerId() && !$message['autoType'] && $view->vars['uid'] > 2;
                if ($message['autoType'] && $message['autoType'] <= 2) {
                    $view->vars['name'] = T("Messages", "Ambassador");
                } else {
                    $view->vars['name'] = $m->getPlayerName($view->vars['uid']);
                }
                $view->vars['isAllianceAutoType'] = $message['autoType'] && $message['autoType'] <= 2;
                $view->vars['reported'] = $message['reported'];
                if (!$view->vars['isAllianceAutoType']) {
                    if ($view->vars['uid'] == 0 || $view->vars['uid'] == 2) {
                        $view->vars['name'] = '<u>' . $view->vars['name'] . '</u>';
                    }
                }
                if (!$message['viewed'] &&
                    $message['to_uid'] == Session::getInstance()->getPlayerId() &&
                    !Session::getInstance()->isAdminInAnotherAccount()) {
                    if ($message['autoType'] == 3) {
                        Quest::getInstance()->setQuestBitwise('world', 6, 1);
                    }
                    $m->setMessageAsViewed($message['id'], $message['to_uid']);
                }
                $this->view->vars['content'] .= $view->output();
            }
        } else if ($selectedTab == 0) {
            $this->Inbox();
        } else if ($selectedTab == 1) {
            $this->write();
        } else if ($selectedTab == 2) {
            $this->sendBox();
        } else if ($selectedTab == 3) {
            $this->Archive();
        } else if ($selectedTab == 4) {
            $view = new PHPBatchView("messages/note");
            $view->vars['note'] = Session::getInstance()->getNote();
            $view->vars['info'] = '';
            if (isset($_POST['notepad'])) {
                $_POST['notepad'] = filter_var($_POST['notepad'], FILTER_SANITIZE_STRING);
                $m = new MessageModel();
                if ($m->setNote(Session::getInstance()->getPlayerId(), $_POST['notepad'])) {
                    $view->vars['note'] = $_POST['notepad'];
                    $view->vars['info'] = T("Messages", "- saved -");
                }
            }
            $this->view->vars['content'] .= $view->output();
        } else if ($selectedTab == 5) {
            $view = new PHPBatchView("messages/ignoreList");
            $this->view->vars['content'] .= $view->output();
        }
        Caching::getInstance()->delete("newMessages{$this->session->getPlayerId()}");
    }

    public function checkMultiUnread($fromPlayerId, $toPlayerId)
    {
        if ($fromPlayerId <= 2 || empty($toPlayerId)) return 0;
        $db = DB::getInstance();
        $limit = 2;
        $count = $db->fetchScalar("SELECT COUNT(id) FROM mdata WHERE viewed=0 AND time >= " . (time() - 2 * 3600) . " AND to_uid=$toPlayerId AND uid=$fromPlayerId AND isAlliance=0");
        if ($toPlayerId == 2 || $toPlayerId == 0) {
            $limit = 3;
        }
        return $count >= $limit;
    }

    public function checkForUnreadSpam($fromPlayerId)
    {
        if ($fromPlayerId <= 2 || empty($fromPlayerId)) return;
        $db = DB::getInstance();
        $count = $db->fetchScalar("SELECT COUNT(id) FROM mdata WHERE viewed=0 AND time >= " . (time() - 2 * 3600) . " AND uid=$fromPlayerId AND isAlliance=0");
        if ($count >= mt_rand(6, 12)) {
            $this->redirect("messages.php?spamDetected=true");
            $uid = Session::getInstance()->getPlayerId();
            $reason = 'Spam';
            $time = 10 * 60;
            $db = DB::getInstance();
            $exists = 0 < $db->fetchScalar("SELECT COUNT(id) FROM banQueue WHERE uid=$uid");
            if (!$exists) {
                $db->query("UPDATE users SET access=0 WHERE id=$uid");
                if ($db->affectedRows()) {
                    $db->query("INSERT INTO `banQueue`(`uid`, `reason`, `time`, `end`) VALUES ($uid, '$reason', " . time() . ", " . ($time == 0 ? $time : $time + time()) . ")");
                    $db->query("INSERT INTO `banHistory`(`uid`, `reason`, `time`, `end`) VALUES ($uid, '$reason', " . time() . ", " . ($time == 0 ? $time : $time + time()) . ")");
                    $db->query("DELETE FROM multiaccount_users WHERE uid=$uid");
                    (new InfoBoxModel())->addInfo($uid, 0, 14, '', time(), time() + 365 * 86400);
                    Notification::notify("Spam blocked", "Lots of unread messages for a player!");
                }
            }
        }
    }

    private function Inbox()
    {
        $m = new MessageModel();
        $view = new PHPBatchView("messages/inbox");
        $view->vars['hasPermission'] = Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_REMOVE_ARCHIVE_MESSAGES_OR_REPORTS);
        if ($view->vars['hasPermission']) {
            if (isset($_GET['toggleState']) && isset($_GET['id'])) {
                $toggle = $_REQUEST['toggleState'] == 'unread' ? 'unread' : 'read';
                $msgId = (int)$_REQUEST['id'];
                if ($toggle == 'read') {
                    $m->setMessageAsViewed($msgId, Session::getInstance()->getPlayerId());
                } else {
                    $m->setMessageAsUnViewed($msgId, Session::getInstance()->getPlayerId());
                }
            }
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 1) != 'n') {
                    continue;
                }
                $msgId = (int)$value;
                $action = isset($_REQUEST['archive']) ? 'archive' : (isset($_REQUEST['delmsg']) ? 'del' : 'bulkread');
                switch ($action) {
                    case 'del':
                        $m->deleteInboxMessage($msgId, Session::getInstance()->getPlayerId());
                        break;
                    case 'archive':
                        if (!Session::getInstance()->hasGoldClub()) {
                            break;
                        }
                        $m->archiveMessage($msgId, Session::getInstance()->getPlayerId());
                        break;
                    case 'bulkread':
                        $m->setMessageAsViewed($msgId, Session::getInstance()->getPlayerId());
                        break;
                }
            }
        }
        $view->vars['selectedTab'] = 0;
        $view->vars['recursive'] = isset($_GET['o']);
        $view->vars['goldClub'] = Session::getInstance()->hasGoldClub();
        $page = isset($_REQUEST['page']) ? abs((int)$_REQUEST['page']) : 1;
        $inbox = $m->getInbox($page, Session::getInstance()->getPlayerId(), $view->vars['recursive']);
        $view->vars['content'] = '';
        $i = 0;
        while ($row = $inbox->fetch_assoc()) {
            ++$i;
            $topic = $this->getSubject($row['autoType'], $row['topic']);
            $isSpecial = $row['uid'] == 0 || $row['uid'] == 2;
            $view->vars['content'] .= '<tr class="' . ($row['uid'] == 0 ? 'support' : ($row['uid'] == 2 ? 'multihunter' : '')) . '">';
            $view->vars['content'] .= '<td class="sel">';
            if ($view->vars['hasPermission']) {
                $view->vars['content'] .= '<input class="check" type="checkbox" name="n' . $i . '" value="' . $row['id'] . '">';
            }
            $view->vars['content'] .= '</td>';
            if ($view->vars['hasPermission']) {
                $view->vars['content'] .= '<td class="subject"><a href="messages.php?id=' . $row['id'] . '&amp;toggleState=' . ($row['viewed'] == 0 ? 'read' : 'unread') . '"><div class="subjectWrapper"><img src="img/x.gif" class="messageStatus messageStatus' . ($row['viewed'] == 1 ? 'Read' : 'Unread') . '" title="' . T("Messages", $row['viewed'] == 1 ? 'Read' : 'Unread') . '"></a><a href="messages.php?id=' . $row['id'] . '">' . $topic . '</a></div></td>';
            } else {
                $view->vars['content'] .= '<td class="subject"><div class="subjectWrapper">' . $topic . '</a></div></td>';
            }
            if ($row['autoType'] && $row['autoType'] <= 2) {
                $view->vars['content'] .= '<td class="send"><a href="' . getAnswersUrl() . 'aid=4#go2answer" target="_blank">' . T("Messages",
                        "Ambassador") . '</a></td>';
            } else {
                $view->vars['content'] .= '<td class="send"><a href="spieler.php?uid=' . $row['uid'] . '">' . ($isSpecial ? '<u>' : '') . $m->getPlayerName($row['uid']) . ($isSpecial ? '</u>' : '') . '</a></td>';
            }
            $view->vars['content'] .= '<td class="dat">' . TimezoneHelper::autoDateString($row['time'], TRUE) . '</td>';
            $view->vars['content'] .= '</tr>';
        }
        if (!$inbox->num_rows) {
            $view->vars['content'] = '<tr><td colspan="4" class="noData">' . T("Messages",
                    'There are no messages available in the inbox') . '</td></tr>';
        }
        $prefix['t'] = 0;
        $p = new PageNavigator($page,
            $m->getInboxCount(Session::getInstance()->getPlayerId()),
            Session::getInstance()->getReportsRecordsPerPage(),
            $prefix,
            "messages.php");
        $view->vars['nav'] = $p->get();
        $this->view->vars['content'] .= $view->output();
    }

    private function write()
    {
        $m = new MessageModel();
        $perm = Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_SEND_OR_ANSWER_MESSAGES);
        if (!$perm) {
            return;
        }
        $m = new MessageModel();
        $pop = Session::getInstance()->get("total_pop");
        $min_pop = Config::getAdvancedProperty("mimMessagePop");
        if (Session::getInstance()->isAdmin()) {
            $min_pop = -1;
        }
        $maxRecipient = $InadmissibleMessage = $spam = $banned = $longSubject = $morePopRequired = $spam2 = false;
        if (WebService::isPost() && isset($_REQUEST['c']) && $_REQUEST['c'] == Session::getInstance()->getChecker()) {
            Session::getInstance()->changeChecker();
            $_REQUEST['an'] = filter_var($_REQUEST['an'], FILTER_SANITIZE_STRING);
            $_REQUEST['be'] = filter_var($_REQUEST['be'], FILTER_SANITIZE_STRING);
            $_REQUEST['be'] = mb_substr($_REQUEST['be'], 0, min(45, strlen($_REQUEST['be'])));
            if (empty($_REQUEST['be'])) {
                $_REQUEST['be'] = T("Messages", "no subject");
            }
            $_REQUEST['message'] = filter_var($_REQUEST['message'], FILTER_SANITIZE_STRING);
            if (Session::getInstance()->isSitter()) {
                $playerName = $m->getPlayerName(Session::getInstance()->getSitterUID());
                $_REQUEST['message'] = sprintf(T("Messages", "WrittenBySitter%s"),
                        $playerName) . PHP_EOL . $_REQUEST['message'];
            }
            $longSubject = strlen($_REQUEST['be']) > 45;
            if ($longSubject) goto process;
            $recipients = array_unique(array_map("trim", explode(";", $_REQUEST['an'])));
            $maxRecipient = sizeof($recipients) > getDisplay("maximumMultiMessageSendNum");
            if ($maxRecipient) goto process;
            $InadmissibleMessage = Session::getInstance()->getPlayerId() > 2 && (!StringChecker::isValidName($_REQUEST['be']) || !StringChecker::isValidMessage($_REQUEST['message']));
            if ($InadmissibleMessage) goto process;
            $banned = Session::getInstance()->data['access'] == 0 && Session::getInstance()->getPlayerId() > 2;
            $db = DB::getInstance();
            $redirect = false;
            foreach ($recipients as $recipient) {
                if (empty($recipient)) continue;
                switch ($recipient) {
                    case '[ally]':
                        if ($banned) goto process;
                        if (Session::getInstance()->getAllianceId() && Session::getInstance()->hasAlliancePermission(AllianceModel::IGM_MESSAGE)) {
                            $lastMsg = $m->checkLastMessage(Session::getInstance()->getPlayerId(),
                                Session::getInstance()->banned(),
                                FALSE,
                                $_REQUEST['be'],
                                $_REQUEST['message']);
                            if ($lastMsg !== FALSE) {
                                $users = $db->query("SELECT id FROM users WHERE aid=" . Session::getInstance()->getAllianceId() . " AND id!=" . Session::getInstance()->getPlayerId());
                                while ($row = $users->fetch_assoc()) {
                                    $m->sendMessage(Session::getInstance()->getPlayerId(),
                                        $row['id'],
                                        $_REQUEST['be'],
                                        $_REQUEST['message'],
                                        0,
                                        1);
                                }
                                $redirect = true;
                            } else {
                                $spam = true;
                            }
                        }
                        break;
                    case '[all]':
                        if (Session::getInstance()->isAdmin() && !Session::getInstance()->isAdminInAnotherAccount()) {
                            $db = DB::getInstance();
                            $users = $db->query("SELECT id FROM users WHERE id > 2 AND access<>2");
                            while ($row = $users->fetch_assoc()) {
                                $m->sendMessage(Session::getInstance()->getPlayerId(),
                                    $row['id'],
                                    $_REQUEST['be'],
                                    $_REQUEST['message']);
                            }
                            $redirect = true;
                        }
                        break;
                    default:
                        $recipientUID = $m->getPlayerIdByName($recipient);
                        if ($recipientUID === false) {
                            goto process;
                        }
                        if ($recipientUID > 2 && $pop < $min_pop) {
                            $morePopRequired = true;
                            goto process;
                        }
                        if ($banned && $recipientUID > 2) goto process;
                        $lastMsg = ($recipientUID == Session::getInstance()->getPlayerId()) ? TRUE : $m->checkLastMessage(Session::getInstance()->getPlayerId(),
                            Session::getInstance()->banned(),
                            FALSE,
                            $_REQUEST['be'],
                            $_REQUEST['message']);
                        $spam2 = ($recipientUID == Session::getInstance()->getPlayerId()) ? FALSE : $this->checkMultiUnread(Session::getInstance()->getPlayerId(),
                            $recipientUID);
                        if ($spam2) goto process;
                        if ($lastMsg == FALSE) {
                            $spam = true;
                            goto process;
                        }
                        $this->checkForUnreadSpam(Session::getInstance()->getPlayerId());
                        $m->sendMessage(Session::getInstance()->getPlayerId(),
                            $recipientUID,
                            $_REQUEST['be'],
                            $_REQUEST['message']);
                        $redirect = true;
                        break;
                }
            }
            if ($redirect) {
                $this->redirect("messages.php");
            }
        }
        process:
        $view = new PHPBatchView("messages/write");
        if ($longSubject) {
            $view->vars['error'] = T("Messages", "Error: Very long subject!");
        } else if ($banned) {
            $view->vars['error'] = T("Messages", "You dont have permission here");
        } else if ($spam) {
            $view->vars['error'] = T("Messages", "Spam protection: Please wait for 10 minutes and try again");
        } else if ($spam2 > 0) {
            $view->vars['error'] = sprintf(T("Messages", "spam_unread_protection"), $spam2);
        } else if ($morePopRequired) {
            $view->vars['error'] = sprintf(T("Messages",
                "Spam protection: You must have at least %s pop to be able to send messages"),
                $min_pop);
        } else if ($maxRecipient) {
            $view->vars['error'] = sprintf(T("Messages", "You cannot send a message to more than %s users"),
                getDisplay("maximumMultiMessageSendNum"));
        }
        $view->vars['InadmissibleMessage'] = $InadmissibleMessage;
        $view->vars['showAddressBook'] = FALSE;
        if (WebService::isPost() && isset($_REQUEST['a']) && $_REQUEST['a'] == Session::getInstance()->getChecker() && $_REQUEST['sbmtype'] == 'default') {
            $total = 20 - $m->getTotalFriendListCount(Session::getInstance()->getPlayerId());
            for ($i = 0; $i <= 19; ++$i) {
                if (!empty($_POST['addfriends'][$i]) && $total) {
                    $uid = $m->getPlayerIdByName($_POST['addfriends'][$i]);
                    if ($uid !== FALSE && $uid != Session::getInstance()->getPlayerId() && !$m->isPlayerInFriendList($uid)) {
                        $m->addFriendList(Session::getInstance()->getPlayerId(), $uid);
                        $total--;
                        $view->vars['showAddressBook'] = TRUE;
                    }
                }
            }
            Session::getInstance()->changeChecker();
        }
        if (isset($_REQUEST['sbmtype']) && $_REQUEST['sbmtype'] == 'delete' && $_REQUEST['a'] == Session::getInstance()->getChecker()) {
            $m->deleteFriend((int)$_REQUEST['sbmvalue'], Session::getInstance()->getPlayerId());
            $view->vars['showAddressBook'] = TRUE;
            Session::getInstance()->changeChecker();
        }
        if (isset($_REQUEST['sbmtype']) && $_REQUEST['sbmtype'] == 'friend_ok' && $_REQUEST['a'] == Session::getInstance()->getChecker()) {
            $m->acceptFriend((int)$_REQUEST['sbmvalue'], Session::getInstance()->getPlayerId());
            $view->vars['showAddressBook'] = TRUE;
            Session::getInstance()->changeChecker();
        }
        $view->vars['addressBook'] = $this->renderAddressBook();
        $view->vars['checker'] = Session::getInstance()->getChecker();
        $view->vars['subject'] = isset($_REQUEST['be']) ? $_REQUEST['be'] : null;
        $view->vars['receiver'] = isset($_REQUEST['an']) ? $_REQUEST['an'] : null;
        $view->vars['message'] = isset($_REQUEST['message']) ? $_REQUEST['message'] : null;
        if (isset($_GET['id'])) {
            if (Session::getInstance()->isAdmin() && $_GET['id'] == '[all]') {
                $view->vars['receiver'] = '[all]';
            } else {
                $view->vars['receiver'] = $m->getPlayerName((int)$_GET['id']);
            }
        }
        if (isset($_POST['id'])) {
            $message = $m->getMessage((int)$_POST['id'], Session::getInstance()->getPlayerId());
            if ($message !== FALSE) {
                $message['message'] = strip_tags($message['message']);
                if ($message['autoType']) {
                } else {
                    $view->vars['subject'] = $message['topic'];
                    if (preg_match("/RE\^([0-9]+)/i", $view->vars['subject'], $c)) {
                        $c = $c[1] + 1;
                        $view->vars['subject'] = preg_replace("/RE\^[0-9]+/i", "RE^" . ($c), $view->vars['subject']);
                    } else {
                        $view->vars['subject'] = "RE^1: " . $view->vars['subject'];
                    }
                    $view->vars['receiver'] = $m->getPlayerName($message['uid']);
                    if ($message['autoType']) {
                        if ($message['autoType'] <= 2) {
                            $data = [Session::getInstance()->getName()];
                            $data = array_merge($data, unserialize($message['message']));
                            $message['message'] = vsprintf(T("Messages", $message['autoType'] == 1 ? "AllianceInvitationReceiveText" : "AllianceInvitationRevokeText"), $data);
                            $message['message'] = str_replace('<br />', "\n", $message['message']);
                        }
                    }
                    $view->vars['message'] = "\n\n" . '____________' . "\n" . sprintf(T("Messages", "xxx wrote:"), $view->vars['receiver']) . "\n\n" . $message['message'];
                }
            }
        }
        $this->view->vars['content'] .= $view->output();
    }

    private function renderAddressBook()
    {
        $m = new MessageModel();
        $addressbook = [];
        for ($i = 0; $i <= 19; ++$i) {
            $addressbook[] = <<<HTML
<td class="end"></td>
                <td class="pla">
                    <input class="text" type="text" name="addfriends[{$i}]" value="" maxlength="15" />
                </td>
                <td class="accept"></td>
HTML;
        }
        $friendlist = $m->getFriendList(Session::getInstance()->getPlayerId());
        $i = 0;
        while ($row = $friendlist->fetch_assoc()) {
            $addressbook[$i] = '';
            $addressbook[$i] .= '<td class="end"><button type="button" class="icon " onclick="window.location.href = \'messages.php?t=1&amp;sbmtype=delete&amp;sbmvalue=' . $row['id'] . '&amp;a=' . Session::getInstance()->getChecker() . '\'; return false;"><img src="img/x.gif" class="del" alt="del"></button></td>';
            $addressbook[$i] .= '<td class="pla">';
            if (!$row['accepted']) {
                $addressbook[$i] .= '<img class="clock" src="img/x.gif" title="' . T("Messages",
                        "waiting for confirmation") . '" alt="' . T("Messages", "waiting for confirmation") . '">';
            } else {
                $row['last_login_time'] = $m->getPlayerLastLoginTime($row['uid'] == Session::getInstance()->getPlayerId() ? $row['to_uid'] : $row['uid']);
                if ((time() - 600) < $row['last_login_time']) { // 0 Min - 10 Min
                    $addressbook[$i] .= "<img class='online online1' src=img/x.gif title='" . T("Messages",
                            "online now") . "' alt='" . T("Messages", "online now") . "' />";
                } else if ((time() - 86400) < $row['last_login_time'] && (time() - 600) > $row['last_login_time']) { // 10 Min - 1 Days
                    $addressbook[$i] .= "<img class='online online2' src=img/x.gif title='" . T("Messages",
                            "active players") . "' alt='" . T("Messages", "active players") . "' />";
                } else if ((time() - 259200) < $row['last_login_time'] && (time() - 86400) > $row['last_login_time']) { // 1-3 Days
                    $addressbook[$i] .= "<img class='online online3' src=img/x.gif title='" . T("Messages",
                            "active 3days") . "' alt='" . T("Messages", "active 3days") . "' />";
                } else if ((time() - 604800) < $row['last_login_time'] && (time() - 259200) > $row['last_login_time']) { // 3-7 Days
                    $addressbook[$i] .= "<img class='online online4' src=img/x.gif title='" . T("Messages",
                            "active 7days") . "' alt='" . T("Messages", "active 7days") . "' />";
                } else {
                    $addressbook[$i] .= '<img class="online online5" src="img/x.gif" title="' . T("Messages",
                            "inactive") . '" alt="' . T("Messages", "inactive") . '" />';
                }
            }
            $addressbook[$i] .= '<a href="#">' . $m->getPlayerName($row['to_uid'] == Session::getInstance()->getPlayerId() ? $row['uid'] : $row['to_uid']) . '</a>';
            $addressbook[$i] .= '</td>';
            $addressbook[$i] .= '<td class="accept">';
            if (!$row['accepted'] && $row['to_uid'] == Session::getInstance()->getPlayerId()) {
                $addressbook[$i] .= '<button type="button" class="icon hover" onclick="window.location.href = \'messages.php?t=1&amp;sbmtype=friend_ok&amp;sbmvalue=' . $row['id'] . '&amp;a=' . Session::getInstance()->getChecker() . '\'; return false;"><img src="img/x.gif" class="accept" alt="accept"></button>';
            }
            $addressbook[$i] .= '</td>';
            ++$i;
        }
        return $addressbook;
    }

    private function sendBox()
    {
        $m = new MessageModel();
        $view = new PHPBatchView("messages/sent");
        $view->vars['hasPermission'] = Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_REMOVE_ARCHIVE_MESSAGES_OR_REPORTS);
        if ($view->vars['hasPermission']) {
            $i = 1;
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 1) != 'n') {
                    continue;
                }
                $msgId = (int)$value;
                $m->deleteSendBoxMessage($msgId, Session::getInstance()->getPlayerId());
                ++$i;
            }
        }
        $view->vars['selectedTab'] = 2;
        $view->vars['recursive'] = isset($_GET['o']);
        $view->vars['goldClub'] = Session::getInstance()->hasGoldClub();
        $page = isset($_REQUEST['page']) ? abs((int)$_REQUEST['page']) : 1;
        $inbox = $m->getSentBox($page, Session::getInstance()->getPlayerId(), $view->vars['recursive']);
        $view->vars['content'] = '';
        $i = 0;
        $config = Config::getInstance();
        while ($row = $inbox->fetch_assoc()) {
            ++$i;
            $topic = $this->getSubject($row['autoType'], $row['topic']);

            $isSpecial = $row['to_uid'] == 0 || $row['to_uid'] == 2;
            $view->vars['content'] .= '<tr class="' . ($row['to_uid'] == 0 ? 'support' : ($row['to_uid'] == 2 ? 'multihunter' : '')) . '">';
            $view->vars['content'] .= '<td class="sel">';
            if ($view->vars['hasPermission']) {
                $view->vars['content'] .= '<input class="check" type="checkbox" name="n' . $i . '" value="' . $row['id'] . '">';
            }
            $view->vars['content'] .= '</td>';
            $view->vars['content'] .= '<td class="subject"><div class="subjectWrapper"><img src="img/x.gif" class="messageStatus messageStatus' . ($row['viewed'] == 1 ? 'Read' : 'Unread') . '" title="' . T("Messages",
                    $row['viewed'] == 1 ? 'Read' : 'Unread') . '" alt="' . T("Messages",
                    $row['viewed'] == 1 ? 'Read' : 'Unread') . '"><a href="messages.php?t=2&id=' . $row['id'] . '">' . $topic . '</a></div></td>';
            if ($row['autoType'] && $row['autoType'] <= 2) {
                $view->vars['content'] .= '<td class="send"><a href="' . $config->settings->availableLanguages->{$config->settings->selectedLang}->AnswersUrl . 'index.php?aid=4#go2answer" target="_blank">' . T("Messages",
                        "Ambassador") . '</a></td>';
            } else {
                $view->vars['content'] .= '<td class="send"><a href="spieler.php?uid=' . $row['to_uid'] . '">' . ($isSpecial ? '<u>' : '') . $m->getPlayerName($row['to_uid']) . ($isSpecial ? '</u>' : '') . '</a></td>';
            }
            $view->vars['content'] .= '<td class="dat">' . TimezoneHelper::autoDateString($row['time'], TRUE) . '</td>';
            $view->vars['content'] .= '</tr>';
        }
        if (!$inbox->num_rows) {
            $view->vars['content'] = '<tr><td colspan="4" class="noData">' . T("Messages",
                    'There are no messages available in the sentbox') . '</td></tr>';
        }
        $prefix['t'] = 2;
        $p = new PageNavigator($page,
            $m->getSentBoxCount(Session::getInstance()->getPlayerId()),
            Session::getInstance()->getReportsRecordsPerPage(),
            $prefix,
            "messages.php");
        $view->vars['nav'] = $p->get();
        $this->view->vars['content'] .= $view->output();
    }

    private function Archive()
    {
        $m = new MessageModel();
        $view = new PHPBatchView("messages/archive");
        $view->vars['hasPermission'] = Session::getInstance()->checkSitterPermission(Session::SITTER_CAN_REMOVE_ARCHIVE_MESSAGES_OR_REPORTS);
        if ($view->vars['hasPermission']) {
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 1) != 'n') {
                    continue;
                }
                $msgId = (int)$value;
                $action = isset($_REQUEST['delmsg']) ? 'del' : (isset($_REQUEST['recover']) ? 'recover' : 'bulkread');
                switch ($action) {
                    case 'del':
                        $m->deleteInboxMessage($msgId, Session::getInstance()->getPlayerId());
                        break;
                    case 'recover':
                        $m->recoverMessage($msgId, Session::getInstance()->getPlayerId());
                        break;
                    case 'bulkread':
                        $m->setMessageAsViewed($msgId, Session::getInstance()->getPlayerId());
                        break;
                }
            }
        }
        $view->vars['selectedTab'] = 3;
        $view->vars['recursive'] = isset($_GET['o']);
        $view->vars['goldClub'] = Session::getInstance()->hasGoldClub();
        $page = isset($_REQUEST['page']) ? abs((int)$_REQUEST['page']) : 1;
        $inbox = $m->getArchive($page, Session::getInstance()->getPlayerId(), $view->vars['recursive']);
        $view->vars['content'] = '';
        $i = 0;
        while ($row = $inbox->fetch_assoc()) {
            ++$i;
            $topic = $this->getSubject($row['autoType'], $row['topic']);

            $isSpecial = $row['uid'] == 0 || $row['uid'] == 2;
            $view->vars['content'] .= '<tr class="' . ($row['uid'] == 0 ? 'support' : ($row['uid'] == 2 ? 'multihunter' : '')) . '">';
            $view->vars['content'] .= '<td class="sel">';
            if ($view->vars['hasPermission']) {
                $view->vars['content'] .= '<input class="check" type="checkbox" name="n' . $i . '" value="' . $row['id'] . '">';
            }
            $view->vars['content'] .= '</td>';
            $view->vars['content'] .= '<td class="subject"><a href="messages.php?id=' . $row['id'] . '&amp;toggleState=' . ($row['viewed'] == 0 ? 'read' : 'unread') . '"><div class="subjectWrapper"><img src="img/x.gif" class="messageStatus messageStatus' . ($row['viewed'] == 1 ? 'Read' : 'Unread') . '" title="' . T("Messages",
                    $row['viewed'] == 1 ? 'Read' : 'Unread') . '" alt="' . T("Messages",
                    $row['viewed'] == 1 ? 'Read' : 'Unread') . '"></a><a href="messages.php?id=' . $row['id'] . '">' . $topic . '</a></div></td>';
            if ($row['autoType'] && $row['autoType'] <= 2) {
                $config = Config::getInstance();
                $view->vars['content'] .= '<td class="send"><a href="' . $config->settings->availableLanguages->{$config->settings->selectedLang}->AnswersUrl . 'index.php?aid=4#go2answer" target="_blank">' . T("Messages",
                        "Ambassador") . '</a></td>';
            } else {
                $view->vars['content'] .= '<td class="send"><a href="spieler.php?uid=' . $row['uid'] . '">' . ($isSpecial ? '<u>' : '') . $m->getPlayerName($row['uid']) . ($isSpecial ? '</u>' : '') . '</a></td>';
            }
            $view->vars['content'] .= '<td class="dat">' . TimezoneHelper::autoDateString($row['time'], TRUE) . '</td>';
            $view->vars['content'] .= '</tr>';
        }
        if (!$inbox->num_rows) {
            $view->vars['content'] = '<tr><td colspan="4" class="noData">' . T("Messages",
                    'There are no messages available in the archive') . '</td></tr>';
        }
        $prefix['t'] = 0;
        $p = new PageNavigator($page,
            $m->getArchiveCount(Session::getInstance()->getPlayerId()),
            Session::getInstance()->getReportsRecordsPerPage(),
            $prefix,
            "messages.php");
        $view->vars['nav'] = $p->get();
        $this->view->vars['content'] .= $view->output();
    }
}