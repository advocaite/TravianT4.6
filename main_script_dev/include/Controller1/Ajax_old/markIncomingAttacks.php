<?php
namespace Controller\Ajax;

use Core\Session;
use Model\MovementsModel;

class markIncomingAttacks extends AjaxBase
{
	public function dispatch()
	{
		$data = array_map('intval', $_POST['data']);
		if(isset($data['id']) && isset($data['state'])) {
			if($data['state'] < 0 || $data['state'] > 3) {
				return;
			}
			$m = new MovementsModel();
			$this->response['data']['result'] = $m->setMovementMarkState(Session::getInstance()->getKid(), $data['id'], $data['state']);
		}
	}
}