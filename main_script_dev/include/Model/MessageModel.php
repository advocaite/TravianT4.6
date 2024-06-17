<?php

namespace Model;

use Core\Caching\Caching;
use Core\Config;
use Core\Database\DB;
use Core\Helper\Notification;
use Core\Session;

class MessageModel
{
    public function getFriendList($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM friendlist WHERE uid=$uid OR to_uid=$uid");
    }

    public function getAdminInbox($page, $pageSize, $order = 0)
    {
        $db = DB::getInstance();
        return $db->query("SELECT * FROM mdata WHERE delete_receiver=0 AND archived=0 AND (to_uid=0 OR to_uid=2) ORDER BY id " . ($order ? "ASC" : "DESC") . " LIMIT " . (($page - 1) * $pageSize) . ", " . $pageSize);
    }

    public function getMessageAdmin($id)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM mdata WHERE id=$id");
        if ($find->num_rows) {
            return $find->fetch_assoc();
        }
        return FALSE;
    }

    public function sendQuestMessage($uid)
    {
        $db = DB::getInstance();
        $result = $db->fetchScalar("SELECT COUNT(id) FROM mdata WHERE to_uid=$uid AND autoType=3");
        if ($result) {
            return;
        }
        $this->sendMessage(0, $uid, null, null, 3);
    }

    public function getPlayerLastLoginTime($uid)
    {
        $db = DB::getInstance();
        return (int)$db->fetchScalar("SELECT last_login_time FROM users WHERE id=$uid");
    }

    public function ignorePlayer($uid, $ignore_id)
    {
        if ($ignore_id <= 2) {
            return FALSE;
        }
        if ($this->isPlayerIgnored($uid, $ignore_id)) {
            return FALSE;
        }
        if (!$this->checkIgnoreListLimit($uid)) {
            return FALSE;
        }
        if ($uid == $ignore_id) {
            return FALSE;
        }
        $db = DB::getInstance();
        $db->query("INSERT INTO ignoreList (uid, ignore_id) VALUES ($uid, $ignore_id)");
        $memcached = Caching::getInstance();
        $memcached->delete("ignoreList{$uid}");

        return TRUE;
    }

    public function isPlayerIgnored($uid, $ignore_id)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM ignoreList WHERE uid=$uid AND ignore_id=$ignore_id") > 0;
    }

    public function checkIgnoreListLimit($uid, $max = 20)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM ignoreList WHERE uid=$uid") < $max;
    }

    public function getIgnoreList($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM ignoreList WHERE uid=$uid");
    }

    public function unIgnorePlayer($uid, $ignore_id)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM ignoreList WHERE uid=$uid AND ignore_id=$ignore_id");
        if ($db->affectedRows()) {
            $memcached = Caching::getInstance();
            $memcached->delete("ignoreList{$uid}");
            return 1;
        }
        return 0;
    }

    public function getPlayerName($uid)
    {
        $db = DB::getInstance();
        return $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
    }

    public function isPlayerInFriendList($id)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM friendlist WHERE uid=$id OR to_uid=$id");
    }

    public function getTotalFriendListCount($uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM friendlist WHERE uid=$uid OR to_uid=$uid");
    }

    public function deleteFriend($id, $uid)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM friendlist WHERE id=$id AND (uid=$uid OR to_uid=$uid)");
    }

    public function setMessageAsViewed($id, $uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE mdata SET viewed=1 WHERE id=$id AND to_uid=$uid");
    }

    public function setMessageAsUnViewed($id, $uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE mdata SET viewed=0 WHERE id=$id AND to_uid=$uid");
    }

    public function setMessageAsReported($id, $rpt)
    {
        $db = DB::getInstance();
        $db->query("UPDATE mdata SET reported=$rpt WHERE id=$id");
    }

    public function getMessage($id, $uid)
    {
        $db = DB::getInstance();
        if ($uid <= 2) {
            $find = $db->query("SELECT * FROM mdata WHERE id=$id");
        } else {
            $find = $db->query("SELECT * FROM mdata WHERE (uid=$uid OR to_uid=$uid) AND id=$id");
        }
        if ($find->num_rows) {
            return $find->fetch_assoc();
        }

        return FALSE;
    }

    public function getMyMessage($id, $uid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM mdata WHERE to_uid=$uid AND id=$id");
        if ($find->num_rows) {
            return $find->fetch_assoc();
        }

        return FALSE;
    }

    public function acceptFriend($id, $uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE friendlist SET accepted=1 WHERE id=$id AND to_uid=$uid");
    }

    public function addFriendList($uid, $to_uid)
    {
        $db = DB::getInstance();
        $db->query("INSERT INTO friendlist (uid, to_uid) VALUES ($uid, $to_uid)");
    }

    public function getPlayerIdByName($name)
    {
        $name = filter_var($name, FILTER_SANITIZE_STRING);
        $db = DB::getInstance();
        $name = $db->real_escape_string($name);
        return $db->fetchScalar("SELECT id FROM users WHERE name='$name'");
    }

    public function deleteInboxMessage($id, $to_uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE mdata SET delete_receiver=1, viewed=1 WHERE to_uid=$to_uid AND id=$id");
    }

    public function archiveMessage($id, $to_uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE mdata SET archived=1, viewed=1 WHERE to_uid=$to_uid AND id=$id");
    }

    public function deleteSendBoxMessage($id, $uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE mdata SET delete_sender=1 WHERE uid=$uid AND id=$id");
    }

    public function setNote($uid, $text)
    {
        $db = DB::getInstance();
        $db->query("UPDATE users SET note='$text' WHERE id=$uid");

        return $db->affectedRows();
    }

    public function recoverMessage($id, $uid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE mdata SET archived=0 WHERE to_uid=$uid AND id=$id");
    }

    public function getHash($subject, $text)
    {
        $db = DB::getInstance();
        $subject = $db->real_escape_string(clean_string_from_white($subject));
        $text = filter_var($db->real_escape_string(($text)));
        $maximum_text_size = strlen($text);
        $md5_checksum = $subject;
        $length = ceil($maximum_text_size / 4);
        $md5_checksum .= substr($text, $maximum_text_size - ($length * 2), $maximum_text_size - ($length * 2));
        $md5_checksum = md5($md5_checksum);
        return $md5_checksum;
    }

    public function checkLastMessage($uid, $banned, $to_uid = FALSE, $subject, $text)
    {
        if ($to_uid !== FALSE && $to_uid <= 2) {
            return TRUE;
        }
        if ($uid <= 2) {
            return TRUE;
        }
        $limit = $banned ? 5 : 15;
        $db = DB::getInstance();
        $result = $db->fetchScalar("SELECT COUNT(id) FROM mdata WHERE uid=$uid AND to_uid>2 AND to_uid!=$uid AND isAlliance=0 AND time>=" . (time() - 10 * 60));
        $alliance = $db->fetchScalar("SELECT COUNT(id) FROM mdata WHERE uid=$uid AND to_uid>2 AND to_uid!=$uid AND isAlliance=1 AND time>=" . (time() - 10 * 60));
        if ($result >= $limit || $alliance >= ($limit - $result) * 20) {
            return FALSE;
        }
        $md5_checksum = $this->getHash($subject, $text);
        return 2 >= $db->fetchScalar("SELECT COUNT(id) FROM mdata WHERE uid=$uid AND md5_checksum='$md5_checksum' AND time >= " . (time() - 600));
    }

    public function getInbox($page, $uid, $order = 0)
    {
        $db = DB::getInstance();
        $ignoreList = [];
        $find = $db->query("SELECT ignore_id FROM ignoreList WHERE uid=$uid");
        while ($row = $find->fetch_assoc()) {
            $ignoreList[] = $row['ignore_id'];
        }
        $filter = sizeof($ignoreList) ? "AND uid NOT IN(" . implode(",", $ignoreList) . ")" : '';

        return $db->query("SELECT * FROM mdata WHERE delete_receiver=0 AND archived=0 AND to_uid=$uid $filter ORDER BY id " . ($order ? "ASC" : "DESC") . " LIMIT " . (($page - 1) * Session::getInstance()->getReportsRecordsPerPage()) . ", " . Session::getInstance()->getReportsRecordsPerPage());
    }

    public function getSentBox($page, $uid, $order = 0)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM mdata WHERE delete_sender=0 AND archived=0 AND uid=$uid ORDER BY id " . ($order ? "ASC" : "DESC") . " LIMIT " . (($page - 1) * Session::getInstance()->getReportsRecordsPerPage()) . ", " . Session::getInstance()->getReportsRecordsPerPage());
    }

    public function getSentBoxCount($uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM mdata WHERE delete_sender=0 AND archived=0 AND uid=$uid");
    }

    public function getInboxCount($uid)
    {
        $db = DB::getInstance();
        $ignoreList = [];
        $find = $db->query("SELECT ignore_id FROM ignoreList WHERE uid=$uid");
        while ($row = $find->fetch_assoc()) {
            $ignoreList[] = $row['ignore_id'];
        }
        $filter = sizeof($ignoreList) ? "AND uid NOT IN(" . implode(",", $ignoreList) . ")" : '';

        return $db->fetchScalar("SELECT COUNT(id) FROM mdata WHERE delete_receiver=0 AND archived=0 AND to_uid=$uid $filter");
    }

    public function getArchive($page, $uid, $order = 0)
    {
        $db = DB::getInstance();
        $ignoreList = [];
        $find = $db->query("SELECT ignore_id FROM ignoreList WHERE uid=$uid");
        while ($row = $find->fetch_assoc()) {
            $ignoreList[] = $row['ignore_id'];
        }
        $filter = sizeof($ignoreList) ? "AND uid NOT IN(" . implode(",", $ignoreList) . ")" : '';

        return $db->query("SELECT * FROM mdata WHERE delete_receiver=0 AND archived=1 AND to_uid=$uid $filter ORDER BY id " . ($order ? "ASC" : "DESC") . " LIMIT " . (($page - 1) * Session::getInstance()->getReportsRecordsPerPage()) . ", " . Session::getInstance()->getReportsRecordsPerPage());
    }

    public function getArchiveCount($uid)
    {
        $db = DB::getInstance();
        $ignoreList = [];
        $find = $db->query("SELECT ignore_id FROM ignoreList WHERE uid=$uid");
        while ($row = $find->fetch_assoc()) {
            $ignoreList[] = $row['ignore_id'];
        }
        $filter = sizeof($ignoreList) ? "AND uid NOT IN(" . implode(",", $ignoreList) . ")" : '';

        return $db->fetchScalar("SELECT COUNT(id) FROM mdata WHERE delete_receiver=0 AND archived=1 AND to_uid=$uid $filter");
    }

    /**
     * @param $uid
     * @param $to_uid
     * @param $subject
     * @param $text
     * @param $autoType
     * AutoType:
     * 1 => Alliance Invitation Received
     * 2 => Alliance Invitation Revoked
     */
    public function sendMessage($uid, $to_uid, $subject, $text, $autoType = 0, $isAlliance = FALSE)
    {
        if ($to_uid == 0) {
            $to_uid = 2;
        }
        $md5_checksum = $this->getHash($subject, $text);
        $db = DB::getInstance();
        $subject = $db->real_escape_string(clean_string_from_white($subject));
        $text = filter_var($db->real_escape_string(($text)));
        $isAlliance = $isAlliance ? 1 : 0;
        $db->query("INSERT INTO mdata (uid, to_uid, topic, message, md5_checksum, time, autoType, isAlliance) VALUES ($uid, $to_uid, '$subject', '$text', '$md5_checksum', " . time() . ", {$autoType}, {$isAlliance})");
        $insertId = $db->lastInsertId();
        if ($uid > 2 && $to_uid <= 2) {
            $gameWorldUrl = Config::getProperty("settings", "gameWorldUrl");
            $link = '<a href="' . $gameWorldUrl . 'messages.php?id=' . $insertId . '">» Answer message</a>';
            $subject = '<a href="' . $gameWorldUrl . 'messages.php?id=' . $insertId . '">' . $subject . '</a>';
            $player = '<a href="' . $gameWorldUrl . 'spieler.php?uid=' . $uid . '">' . $this->getPlayerName($uid) . '</a>';
            $world = '<a href="' . $gameWorldUrl . '">' . Config::getProperty("settings", "worldId") . '</a>';
            Notification::RealTimeNotify("Support needed",
                "You have a new message with subject of $subject from player $player on world $world. <br /> $link");
        }
        return $insertId;
    }
} 