<?php

namespace Controller\Ajax\map;

use Controller\Ajax\AjaxBase;
use Core\Database\DB;
use Core\Session;
use Game\Formulas;
use Game\Map\Map;
use Core\Locale;
use Model\AllianceModel;

class multiMark extends AjaxBase
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
            $this->response['message'] = T("map", "invalid_coordinates");
            return;
        }
        $kid = Formulas::xy2kid($data['x'], $data['y']);
        $db = DB::getInstance();
        $row = $db->query("SELECT oasistype, occupied FROM wdata WHERE id=$kid")->fetch_assoc();
        if (!$row['occupied']) {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("map", "invalid_coordinates");
            return;
        }
        if ($color < 0 || $color > 9) {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("map", "colour_does_not_exists");
            return;
        }
        $totalNow = $db->fetchScalar("SELECT COUNT(id) FROM mapflag WHERE uid=" . Session::getInstance()->getPlayerId() . " AND type!=2");
        if ($totalNow >= 10) {
            $this->response['error'] = TRUE;
            $this->response['message'] = T("map", "mapMarksLimitReached");
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
                $this->response['message'] = T("map", "no_alliance_map_mark_error");
                return;
            }
            $targetId = $alliance;
            $targetName = $db->fetchScalar("SELECT tag FROM alidata WHERE id=$alliance");
        }
        $this->response['color'] = (int)$color;
        $searchType = $type == 'player' ? 0 : ($type == 'alliance' ? 1 : 2);
        $db = DB::getInstance();
        if ($owner == 'player') {
            $db->query("INSERT INTO mapflag (aid, uid, targetId, text, color, type) VALUES (0," . Session::getInstance()->getPlayerId() . "," . $targetId . ",'',$color,$searchType)");
        } else {
            $db->query("INSERT INTO mapflag (aid, uid, targetId, text, color, type) VALUES (" . Session::getInstance()->getAllianceId() . ",0," . $targetId . ",'',$color,$searchType)");
        }
        if ($insertId = $db->lastInsertId()) {
            $this->response['dataId'] = $insertId;
            $this->response['markId'] = $kid;
            $this->response['owner'] = $owner;
            $this->response['position'] = $kid;
            $this->response['text'] = filter_var($targetName, FILTER_SANITIZE_STRING);
			$this->response['result'] = TRUE;
            if ($owner == 'alliance') {
                Map::removeMapCacheForAlliance(Session::getInstance()->getAllianceId(), $type, $targetId);
            } else {
                Map::removeMapCacheForPlayer(Session::getInstance()->getPlayerId(), $type, $targetId);
            }
        }
    }
	
	public function performPatch($data){
		$color = $data['color'];
		$dataId = $data['dataId'];
		$owner = $data['owner'];
		if($owner == 'alliance' && !Session::getInstance()->hasAlliancePermission(AllianceModel::MANAGE_MARKS)) {
			return;
		}
		if($color < 0 || $color > 9) {
			$this->response['error'] = TRUE;
			$this->response['message'] = T("map", "colour_does_not_exists");

			return;
		}
		$db = DB::getInstance();
		$find = $db->query("SELECT targetId, type FROM mapflag WHERE id=$dataId");
		if($find->num_rows) {
			$row = $find->fetch_assoc();
			if($row['type'] > 1) {
				return;
			}
			$type = $row['type'] == 0 ? 'player' : 'alliance';
			if($owner == 'alliance') {
				$db->query("UPDATE mapflag SET color='$color' WHERE aid=".Session::getInstance()->getAllianceId()." AND id=$dataId");
			} else {
				$db->query("UPDATE mapflag SET color='$color' WHERE uid=".Session::getInstance()->getPlayerId()." AND id=$dataId");
			}
			if($db->affectedRows()) {
				if($owner == 'alliance') {
					Map::removeMapCacheForAlliance(Session::getInstance()->getAllianceId(), $type, $row['targetId']);
				} else {
					Map::removeMapCacheForPlayer(Session::getInstance()->getPlayerId(), $type, $row['targetId']);
				}
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