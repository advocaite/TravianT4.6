<?php
namespace Controller\Ajax;
use Core\Database\DB;
use Core\Session;
use Game\Map\Map;
use Core\Locale;
use Model\AllianceModel;
class mapMultiMarkUpdate extends AjaxBase
{
	public function dispatch()
	{
		$data = $_POST['data'];
		$color = $data['color'];
		$dataId = $data['dataId'];
		$owner = $data['owner'];
		if($owner == 'alliance' && !Session::getInstance()->hasAlliancePermission(AllianceModel::MANAGE_MARKS)) {
			return;
		}
		if($color < 0 || $color > 9) {
			$this->response['error'] = TRUE;
			$this->response['errorMsg'] = T("map", "colour_does_not_exists");

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
				$this->response['data']['result'] = TRUE;
			} else {
				$this->response['error'] = TRUE;
				$this->response['errorMsg'] = T("map", "mark_not_found");
			}
		} else {
			$this->response['error'] = TRUE;
			$this->response['errorMsg'] = T("map", "mark_not_found");
		}
	}
} 