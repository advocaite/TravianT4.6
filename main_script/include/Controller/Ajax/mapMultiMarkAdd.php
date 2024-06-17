<?php

namespace Controller\Ajax;

use Core\Database\DB;
use Core\Session;
use Game\Formulas;
use Game\Map\Map;
use Core\Locale;
use Model\AllianceModel;

class mapMultiMarkAdd extends AjaxBase
{
    public function dispatch()
    {
        $data = $_POST['data'];
        $type = $data['type'];
        $owner = $data['owner'];
        $color = $data['color'];
        if ($owner == 'alliance'
            && !Session::getInstance()->hasAlliancePermission(AllianceModel::MANAGE_MARKS)
        ) {
            return;
        }
        if ($data['x'] == "" || $data['y'] == "") {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("map", "invalid_coordinates");
            return;
        }
        $kid = Formulas::xy2kid($data['x'], $data['y']);
        $db = DB::getInstance();
        $row = $db->query("SELECT oasistype, occupied FROM wdata WHERE id=$kid")->fetch_assoc();
        if (!$row['occupied']) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("map", "invalid_coordinates");
            return;
        }
        if ($color < 0 || $color > 9) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("map", "colour_does_not_exists");
            return;
        }
        $totalNow = $db->fetchScalar("SELECT COUNT(id) FROM mapflag WHERE uid=" . Session::getInstance()->getPlayerId() . " AND type!=2");
        if ($totalNow >= 10) {
            $this->response['error'] = TRUE;
            $this->response['errorMsg'] = T("map", "mapMarksLimitReached");
            return;
        }
        if ($row['oasistype']) {
            $playerId = $db->fetchScalar("SELECT owner FROM odata WHERE kid=$kid");
        } else {
            $playerId = $db->fetchScalar("SELECT owner FROM vdata WHERE kid=$kid");
        }
        $targetName = '';
        if ($type == 'player') {
            $targetName = $db->fetchScalar("SELECT name FROM users WHERE id=$playerId");
        }
        $targetId = $playerId;
        if ($type == "alliance") {
            $alliance = $db->fetchScalar("SELECT aid FROM users WHERE id=$playerId");
            if (!$alliance) {
                $this->response['error'] = TRUE;
                $this->response['errorMsg'] = T("map", "no_alliance_map_mark_error");
                return;
            }
            $targetId = $alliance;
            $targetName = $db->fetchScalar("SELECT tag FROM alidata WHERE id=$alliance");
        }
        $this->response['data']['color'] = (int)$color;
        $searchType = $type == 'player' ? 0 : ($type == 'alliance' ? 1 : 2);
        $db = DB::getInstance();
        if ($owner == 'player') {
            $db->query("INSERT INTO mapflag (aid, uid, targetId, text, color, type) VALUES (0," . Session::getInstance()->getPlayerId() . "," . $targetId . ",'',$color,$searchType)");
        } else {
            $db->query("INSERT INTO mapflag (aid, uid, targetId, text, color, type) VALUES (" . Session::getInstance()->getAllianceId() . ",0," . $targetId . ",'',$color,$searchType)");
        }
        if ($insertId = $db->lastInsertId()) {
            $this->response['data']['dataId'] = $insertId;
            $this->response['data']['markId'] = $kid;
            $this->response['data']['owner'] = $owner;
            $this->response['data']['position'] = $kid;
            $this->response['data']['text'] = filter_var($targetName, FILTER_SANITIZE_STRING);
            if ($owner == 'alliance') {
                Map::removeMapCacheForAlliance(Session::getInstance()->getAllianceId(), $type, $targetId);
            } else {
                Map::removeMapCacheForPlayer(Session::getInstance()->getPlayerId(), $type, $targetId);
            }
        }
    }
}