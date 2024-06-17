<?php
namespace Controller\Ajax;

use Core\Database\DB;
use Core\Session;
use Game\Formulas;
use Core\Locale;
use Model\AllianceModel;

class mapFlagAdd extends AjaxBase
{
    public function dispatch()
    {
        $data = $_REQUEST['data'];
        $color = $data['color'];
        if($data['x'] == "" || $data['y'] == "") {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("map", "invalid_coordinates");

            return;
        }
        $kid = Formulas::xy2kid($data['x'], $data['y']);
        if($kid < 0 || $kid > pow((2 * MAP_SIZE + 1), 2)) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("map", "invalid_coordinates");
            return;
        }
        if($color < ($data['owner'] == 'player' ? 0 : 10) || $color > ($data['owner'] == 'player' ? 10 : 20)) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("map", "colour_does_not_exists");
            return;
        }
        $data['text'] = isset($data['text']) ? filter_var($data['text'], FILTER_SANITIZE_STRING) : '';
        if($data['text'] == "") {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("map", "please_resend_all_data");
            return;
        }
        if(strlen($data['text']) > 50) {
            return;
        }
        $owner = $data['owner'];
        if($owner == 'alliance' && !Session::getInstance()->hasAlliancePermission(AllianceModel::MANAGE_MARKS)) {
            return;
        }
        $db = DB::getInstance();
        $totalNow = $db->fetchScalar("SELECT COUNT(id) FROM mapflag WHERE uid=" . Session::getInstance()->getPlayerId() . " AND type=2");
        if($totalNow >= 5) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("map", "mapFlagsLimitReached");
            return;
        }
        $data['text'] = $db->real_escape_string($data['text']);
        $this->response['data']['dataId'] = '';
        if($owner == 'player') {
            $db->query("INSERT INTO mapflag (aid, uid, targetId, text, color, type) VALUES (0," . Session::getInstance()->getPlayerId() . "," . $kid . ",'" . $data['text'] . "',$color,2)");
        } else {
            $db->query("INSERT INTO mapflag (aid, uid, targetId, text, color, type) VALUES (" . Session::getInstance()->getAllianceId() . ",0," . $kid . ",'" . $data['text'] . "',$color,2)");
        }
        $this->response['data']['dataId'] = $db->lastInsertId();
        $this->response['data']['index'] = (int)$data['color'];
        $this->response['data']['kid'] = (int)$kid;
        $this->response['data']['position'] = Formulas::kid2xy($kid);
        $this->response['data']['text'] = $data['text'];
    }
} 