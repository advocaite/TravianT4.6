<?php

use Core\Database\DB;
use Core\Helper\WebService;
use Core\Session;
use Model\AllianceModel;
use Model\StatisticsModel;

class EditAllianceCtrl
{
    public function __construct()
    {
        $this->db = DB::getInstance();
        $section = isset($_REQUEST['section']) ? $_REQUEST['section'] : null;
        if (!isServerFinished() && $section == 'deleteAlliance' && isset($_REQUEST['aid'])) {
            $aid = (int)$_REQUEST['aid'];
            $m = new AllianceModel();
            $db = $this->db;
            $result = $db->query("SELECT id FROM users WHERE aid=$aid");
            while ($row = $result->fetch_assoc()) {
                $m->leaveAlliance($row['id'], $aid);
            }
            AdminLog::getInstance()->addLog("Deleted an alliance.");
        } else if (!isServerFinished() && $section == 'editAll' && isset($_REQUEST['aid']) && WebService::isPost() && Session::validateChecker()) {
            ;
            $this->db->query("UPDATE alidata SET
                                                  name='".$this->db->real_escape_string(filter_var($_POST['name']))."',
                                                  tag='".$this->db->real_escape_string(filter_var($_POST['tag']))."',
                                                  desc1='".$this->db->real_escape_string(filter_var($_POST['desc1']))."',
                                                  desc2='".$this->db->real_escape_string(filter_var($_POST['desc2']))."'
                                                  WHERE id=" . (int)$_POST['aid']);
            $dispatcher = Dispatcher::getInstance();
            $dispatcher->appendContent("<hr><p class='error center'>Changes made....</p><hr>");
            AdminLog::getInstance()->addLog("Edited alliance(" . (int)$_REQUEST['aid'] . ")");
        }
        $this->showEditAlliance((int)$_REQUEST['aid']);
    }

    private function showEditAlliance($aid)
    {
        $dispatcher = Dispatcher::getInstance();
        $aliData = $this->db->query("SELECT * FROM alidata WHERE id=$aid");
        if (!$aliData->num_rows) {
            $dispatcher->appendContent("<hr><p class='error center'>Alliance does not exists!</p><hr>");
            return;
        }
        $aliData = $aliData->fetch_assoc();
        $statistics = new StatisticsModel();
        $params['allianceId'] = $aliData['id'];
        $params['tag'] = $aliData['tag'];
        $params['desc1'] = $aliData['desc1'];
        $params['desc2'] = $aliData['desc2'];
        $params['name'] = $aliData['name'];
        $params['allianceRank'] = $statistics->getAllianceRankById($aid);
        $params['points'] = 0;
        $params['position'] = null;
        $params['hasPosition'] = false;
        $params['MembersHTML'] = null;
        $members = $this->db->query("SELECT users.id, users.name, users.last_login_time, users.alliance_role, users.alliance_role_name,
        (SELECT COUNT(vdata.kid) FROM vdata WHERE vdata.owner=users.id) as `total_villages`,
        (SELECT SUM(vdata.pop) FROM vdata WHERE vdata.owner=users.id) as `total_pop`
        FROM users WHERE users.aid=$aid ORDER BY `total_pop` DESC");
        $rank = 0;
        $isMyAlliance = true;
        while ($row = $members->fetch_assoc()) {
            ++$rank;
            $params['points'] += $row['total_pop'];
            if ($row['alliance_role_name'] != '') {
                $params['hasPosition'] = TRUE;
                $params['position'] .= '<tr><th>' . $row['alliance_role_name'] . '</th><td><a href="admin.php?action=editPlayer&uid=' . $row['id'] . '">' . $row['name'] . '</a></td></tr>';
                //has role!
            }
            $login_stat = '';
            if ($isMyAlliance) {
                if ((time() - 600) < $row['last_login_time']) { // 0 Min - 10 Min
                    $login_stat = "<img class='online online1' src=img/x.gif title='" . T("Alliance", "online now") . "' alt='" . T("Alliance", "online now") . "' />";
                } else if ((time() - 86400) < $row['last_login_time'] && (time() - 600) > $row['last_login_time']) { // 10 Min - 1 Days
                    $login_stat = "<img class='online online2' src=img/x.gif title='" . T("Alliance", "active players") . "' alt='" . T("Alliance", "active players") . "' />";
                } else if ((time() - 259200) < $row['last_login_time'] && (time() - 86400) > $row['last_login_time']) { // 1-3 Days
                    $login_stat = "<img class='online online3' src=img/x.gif title='" . T("Alliance", "active 3days") . "' alt='" . T("Alliance", "active 3days") . "' />";
                } else if ((time() - 604800) < $row['last_login_time'] && (time() - 259200) > $row['last_login_time']) { // 3-7 Days
                    $login_stat = "<img class='online online4' src=img/x.gif title='" . T("Alliance", "active 7days") . "' alt='" . T("Alliance", "active 7days") . "' />";
                } else {
                    $login_stat = '<img class="online online5" src="img/x.gif" title="' . T("Alliance", "inactive") . '" alt="' . T("Alliance", "inactive") . '" />';
                }
            }
            $params['MembersHTML'] .= '<tr><td class="order">' . $rank . '</td><td class="pla"><a href="admin.php?action=editPlayer&uid=' . $row['id'] . '">' . $row['name'] . '</a></td><td class="hab">' . $row['total_pop'] . '</td><td class="vil">' . $row['total_villages'] . '</td><td class="on">' . $login_stat . '</td></tr>';
        }
        $params['Members'] = $rank;


        $dispatcher->appendContent(Template::getInstance()->load($params, 'tpl/editAlliance.tpl')->getAsString());
    }
}
