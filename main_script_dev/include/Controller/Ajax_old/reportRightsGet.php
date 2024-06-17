<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Session;
use Game\NoticeHelper;

class reportRightsGet extends AjaxBase
{
    public function dispatch()
    {
        $reportId = (int)$_POST['reportId'];
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
        $this->response['data']['result'] = FALSE;
        $this->response['data']['right1'] = $data['permissions']['prem'] & RIGHT_OPPONENT_HIDE;
        $this->response['data']['right2'] = $data['permissions']['prem'] & RIGHT_MYSELF_HIDE;
        $this->response['data']['right3'] = $data['permissions']['prem'] & RIGHT_HIDE_OWN_TROOPS;
        $this->response['data']['right4'] = $data['permissions']['prem'] & RIGHT_HIDE_OPPONENT_TROOPS;
        $this->response['data']['description'] = $data['permissions']['desc'];
    }
} 