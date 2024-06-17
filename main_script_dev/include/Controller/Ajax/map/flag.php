<?php

namespace Controller\Ajax\map;

use Controller\Ajax\AjaxBase;
use Core\Database\DB;
use Core\Session;
use Game\Formulas;
use Core\Locale;
use Model\AllianceModel;

class flag extends AjaxBase
{
	public function dispatch()
    {
        $data = $_POST['data'];
		if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
			return $this->performDelete($data);
		}
		else if($_SERVER['REQUEST_METHOD'] == 'POST'){
			return $this->performPost($data);
		}
		else if($_SERVER['REQUEST_METHOD'] == 'PATCH'){
			return $this->performPatch($data);
		}
    }
	
	public function performDelete($data){
		$owner = filter_var(data['owner'], FILTER_SANITIZE_STRING);
        $dataId = (int)$data['dataId'];
        $db = DB::getInstance();
        if ($owner == 'alliance' && !Session::getInstance()->hasAlliancePermission(AllianceModel::MANAGE_MARKS)) {
            return;
        }
        $find = $db->query("SELECT targetId, type FROM mapflag WHERE id=$dataId");
        if ($find->num_rows) {
            $row = $find->fetch_assoc();
            $searchType = $row['type'] == 0 ? 'player' : ($row['type'] == 1 ? 'alliance' : 'flag');
            if ($owner == 'alliance') {
                $db->query("DELETE FROM mapflag WHERE aid=" . Session::getInstance()->getAllianceId() . " AND id=$dataId");
            } else {
                $db->query("DELETE FROM mapflag WHERE uid=" . Session::getInstance()->getPlayerId() . " AND id=$dataId");
            }
            if ($db->affectedRows()) {
                if ($searchType != 'flag') {
                    if ($owner == 'player') {
                        Map::removeMapCacheForPlayer(Session::getInstance()->getPlayerId(),
                            $searchType,
                            $row['targetId']);
                    } else {
                        Map::removeMapCacheForAlliance(Session::getInstance()->getAllianceId(),
                            $searchType,
                            $row['targetId']);
                    }
                }
                $this->response['result'] = TRUE;
            }
        }
	}
	
	public function performPost($data){
		$color = $data['color'];
        if($data['x'] == "" || $data['y'] == "") {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("map", "invalid_coordinates");

            return;
        }
        $kid = Formulas::xy2kid($data['x'], $data['y']);
        if($kid < 0 || $kid > pow((2 * MAP_SIZE + 1), 2)) {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("map", "invalid_coordinates");
            return;
        }
		
        if($color < ($data['owner'] == 'player' ? 0 : 10) || $color > ($data['owner'] == 'player' ? 10 : 20)) {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("map", "colour_does_not_exists");
            return;
        }
        $data['text'] = isset($data['text']) ? filter_var($data['text'], FILTER_SANITIZE_STRING) : '';
        if($data['text'] == "") {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("map", "please_resend_all_data");
            return;
        }
        if(strlen($data['text']) > 50) {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("map", "message_to_long");
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
            $this->response['message'] = T("map", "mapFlagsLimitReached");
            return;
        }
        $data['text'] = $db->real_escape_string($data['text']);
        $this->response['dataId'] = '';

		if($owner == 'player') {
			$db->query("INSERT INTO mapflag (aid, uid, targetId, text, color, type) VALUES (0," . Session::getInstance()->getPlayerId() . "," . $kid . ",'" . $data['text'] . "',$color,2)");
		} else {
			$db->query("INSERT INTO mapflag (aid, uid, targetId, text, color, type) VALUES (" . Session::getInstance()->getAllianceId() . ",0," . $kid . ",'" . $data['text'] . "',$color,2)");
		}
        $this->response['dataId'] = $db->lastInsertId();
        $this->response['index'] = (int)$data['color'];
        $this->response['kid'] = (int)$kid;
        $this->response['position'] = Formulas::kid2xy($kid);
        $this->response['text'] = $data['text'];
		$this->response['result'] = TRUE;
	}

	public function performPatch($data){
		$dataId = $data['dataId'];
		$index = $data['index'];
		$owner = $data['owner'];
		$text = filter_var($data['text'], FILTER_SANITIZE_STRING);
		if($index < ($data['owner'] == 'player' ? 0 : 10) || $index > ($data['owner'] == 'player' ? 10 : 20)) {
			$this->response['error'] = TRUE;
			$this->response['message'] = T("map", "colour_does_not_exists");

			return;
		}
		if($data['text'] == "") {
			$this->response['error'] = TRUE;
			$this->response['message'] = T("map", "please_resend_all_data");

			return;
		}
		$searchType = 2;
		$db = DB::getInstance();
		$find = $db->query("SELECT targetId FROM mapflag WHERE id=$dataId");
		if($find->num_rows) {
			if($owner == 'alliance') {
				$db->query("UPDATE mapflag SET text='$text', color='$index' WHERE type=$searchType AND aid=".Session::getInstance()->getAllianceId()." AND id=$dataId");
			} else {
				$db->query("UPDATE mapflag SET text='$text', color='$index'  WHERE type=$searchType AND uid=".Session::getInstance()->getPlayerId()." AND id=$dataId");
			}
			if($db->affectedRows()) {
				$this->response['result'] = TRUE;
			} else {
				$this->response['error'] = TRUE;
				$this->response['message'] = T("map", "mark_not_found");
			}
		} else {
			$this->response['error'] = TRUE;
			$this->response['message'] = T("map", "mark_not_found");
		}
	}
}