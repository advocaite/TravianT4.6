<?php

use Core\Database\DB;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Model\InfoBoxModel;
use Model\VillageModel;

class BannedListCtrl
{
    public function __construct()
    {
        $db = DB::getInstance();
        $params['uid'] = null;
        if (isset($_REQUEST['uid'])) {
            $params['uid'] = (int)$_REQUEST['uid'];
        }
        if (isset($_REQUEST['section']) && $_REQUEST['section'] == 'unban') {
            $uid = (int)$_REQUEST['uid'];
            $db->query("UPDATE users SET access=1 WHERE id=$uid");
            if ($db->affectedRows()) {
                (new InfoBoxModel())->deleteInfoByType($uid, 14);
            }
            $db->query("DELETE FROM banQueue WHERE uid=$uid");
            AdminLog::getInstance()->addLog("UnBanned " . $this->getPlayerName($uid) . ".");
        }
        if (WebService::isPost()) {
            $uid = (int)$_POST['uid'];
            $reason = $_POST['reason'];
            $time = (int)$_POST['time'];
            $exists = 0 < $db->fetchScalar("SELECT COUNT(id) FROM banQueue WHERE uid=$uid");
            if (!$exists) {
                $db->query("UPDATE users SET access=0 WHERE id=$uid");
                if ($db->affectedRows()) {
                    $db->query("INSERT INTO `banQueue`(`uid`, `reason`, `time`, `end`) VALUES ($uid, '$reason', " . time() . ", " . ($time == 0 ? $time : $time + time()) . ")");
                    $db->query("INSERT INTO `banHistory`(`uid`, `reason`, `time`, `end`) VALUES ($uid, '$reason', " . time() . ", " . ($time == 0 ? $time : $time + time()) . ")");
                    $db->query("DELETE FROM multiaccount_users WHERE uid=$uid");
                    (new InfoBoxModel())->addInfo($uid, 0, 14, '', time(), time() + 365 * 86400);
                    AdminLog::getInstance()->addLog("Banned " . $this->getPlayerName($uid) . ".");
                }
            }
            $params['reason'] = $reason;
            $params['time'] = $time;
        }
        $page = isset($_GET['p']) ? abs((int)$_GET['p']) : 1;
        $result = $db->query("SELECT * FROM banQueue ORDER BY end DESC, id ASC LIMIT " . (($page - 1) * $this->pageSize) . ", {$this->pageSize}");
        $banned_arr = [];
        $params['content'] = null;
        while ($row = $result->fetch_assoc()) {
            $banned_arr[] = $row['uid'];
            $params['content'] .= '<tr>';
            $params['content'] .= '<td class="on"><a href="?action=editPlayer&uid=' . $row['uid'] . '">' . ($name = $this->getPlayerName($row['uid'])) . '</a></td>';
            if ($row['end'] == 0) {
                $params['content'] .= '<td class="on"><span class="f7">' . TimezoneHelper::autoDateString($row['time'],
                        TRUE) . ' - Forever</td>';
            } else {
                $params['content'] .= '<td class="on"><span class="f7">' . TimezoneHelper::autoDateString($row['time'],
                        TRUE) . ' - ' . TimezoneHelper::autoDateString($row['end'], TRUE) . '</td>';
            }
            $params['content'] .= '<td class="on">' . $row['reason'] . '</td>';
            $params['content'] .= '<td><a href="?action=bannedList&section=unban&uid=' . $row['uid'] . '&id=' . $row['id'] . '" onClick="return del(\'unban\',\'' . $name . '\')"><img src="img/x.gif" class="del" title="cancel" alt="cancel"></a></td>';
            $params['content'] .= '<td class="on"><a href="?action=editPlayer&section=punishPlayer&uid=' . $row['uid'] . '&ref=bannedList" onClick="return del(\'unban\',\'' . $name . '\')">Punish</a></td>';
            $params['content'] .= '</tr>';
        }
        if (!$result->num_rows) {
            $params['content'] .= '<tr><td colspan="6" class="hab"><span class="errorMessage">No Players are Banned</span></td></tr>';
        }
        $params['navigator'] = $this->getNavigator($page,
            $db->fetchScalar("SELECT COUNT(id) FROM banQueue"),
            ['action' => 'bannedList']);
        $params['total'] = $db->fetchScalar("SELECT COUNT(id) FROM banQueue");
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/ban.tpl')->getAsString());
    }

    private function getPlayerName($uid)
    {
        $db = DB::getInstance();
        $find = $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
        if ($find)
            return $find;
        return 'n/a';
    }

    const NEXT_SHAPE = '»';
    const PREVIOUS_SHAPE = '«';
    private $pageSize = 50;

    private function previousPageNavigator($page, $num_rows, $prefix = [])
    {
        $text = self::PREVIOUS_SHAPE;
        $total_pages = ceil($num_rows / $this->pageSize);
        if (($page - 1) >= 1 && ($page - 1) <= $total_pages) {
            $prefix['p'] = --$page;
            $query = http_build_query($prefix);
            return '<a href="?' . $query . '">' . $text . '</a>';
        }
        return $text;
    }

    private function nextPageNavigator($page, $num_rows, $prefix = [])
    {
        $text = self::NEXT_SHAPE;
        $total_pages = ceil($num_rows / $this->pageSize);
        if ((1 + $page) <= $total_pages) {
            $prefix['p'] = ++$page;
            $query = http_build_query($prefix);
            return '<a href="?' . $query . '">' . $text . '</a>';
        }
        return $text;
    }

    private function getNavigator($page, $num_rows, $prefix = [])
    {
        return $this->previousPageNavigator($page, $num_rows, $prefix) . ' | ' . $this->nextPageNavigator($page,
                $num_rows,
                $prefix);
    }
}