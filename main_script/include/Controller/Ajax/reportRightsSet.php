<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Session;
use Game\NoticeHelper;

class reportRightsSet extends AjaxBase
{
    public function dispatch()
    {
        $reportId = (int)$_POST['data']['reportId'];
        $db = DB::getInstance();
        $report = $db->query("SELECT * FROM ndata WHERE id=$reportId");
        if (!$report->num_rows) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'Report not found.';
            return TRUE;
        }
        $row = $report->fetch_assoc();
        $report->free();
        if ($row['uid'] <> Session::getInstance()->getPlayerId()) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'Go for it! you cannot!';
            return TRUE;
        }
        $data = NoticeHelper::parseReport($row['type'], $row['data']);
        if (!in_array($row['type'],
                [
                    NoticeHelper::TYPE_WON_AS_ATTACK_WITHOUT_CASUALTIES,
                    NoticeHelper::TYPE_WON_AS_ATTACK_WITH_CASUALTIES,
                    NoticeHelper::TYPE_LOST_AS_ATTACKER, //defense
                    NoticeHelper::TYPE_WON_DEFENSE_WITHOUT_LOSSES,
                    NoticeHelper::TYPE_WON_DEFENSE_WITH_LOSSES,
                    NoticeHelper::TYPE_LOST_AS_DEFENDER_WITH_CASUALTIES,
                    NoticeHelper::TYPE_LOST_AS_DEFENDER_WITHOUT_CASUALTIES,
                    NoticeHelper::TYPE_WON_SPY_AS_DEFENDER_LETTING_ATTACKER_SPY,
                ])
            || isset($row['isEnforcement']) && $row['isEnforcement']
        ) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = 'You can`t set permission for this report type.!';

            return TRUE;
        }
        if (!isset($data['permissions'])) {
            $data['permissions'] = ["prem" => 0, "desc" => ''];
        }
        $prm = 0;
        if ($_POST['data']['right1'] === 'true') {
            $prm |= RIGHT_OPPONENT_HIDE;
        }
        if ($_POST['data']['right2'] === 'true') {
            $prm |= RIGHT_MYSELF_HIDE;
        }
        if ($_POST['data']['right3'] === 'true') {
            $prm |= RIGHT_HIDE_OWN_TROOPS;
        }
        if ($_POST['data']['right4'] === 'true') {
            $prm |= RIGHT_HIDE_OPPONENT_TROOPS;
        }
        $desc = filter_var($_POST['data']['description'], FILTER_SANITIZE_STRING);
        $data['permissions'] = ["prem" => $prm, "desc" => $desc];
        $data = $db->real_escape_string(NoticeHelper::convertReport($row['type'], $data));
        $db->query("UPDATE ndata SET data='$data' WHERE id=$reportId") or die("failed!");
        $this->response['data']['result'] = 0;
    }
} 