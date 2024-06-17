<?php
namespace Controller\Ajax;


use Core\Database\DB;
use Core\Session;
use Core\Locale;

class mapFlagUpdate extends AjaxBase
{
	public function dispatch()
	{
		$data = $_POST['data'];
		$dataId = $data['dataId'];
		$index = $data['index'];
		$owner = $data['owner'];
		$text = filter_var($data['text'], FILTER_SANITIZE_STRING);
		if($index < ($data['owner'] == 'player' ? 0 : 10) || $index > ($data['owner'] == 'player' ? 10 : 20)) {
			$this->response['error'] = TRUE;
			$this->response['errorMsg'] = T("map", "colour_does_not_exists");

			return;
		}
		if($data['text'] == "") {
			$this->response['error'] = TRUE;
			$this->response['errorMsg'] = T("map", "please_resend_all_data");

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