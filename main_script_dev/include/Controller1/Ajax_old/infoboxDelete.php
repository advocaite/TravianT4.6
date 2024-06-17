<?php
namespace Controller\Ajax;
use Core\Session;
use Model\InfoBoxModel;
class infoboxDelete extends AjaxBase
{
	public function dispatch()
	{
		$id = (int)$_POST['id'];
		$m = new InfoBoxModel();
		if($m->setInfoBoxItemAsDeleted(Session::getInstance()->getPlayerId(), $id)) {
			$this->response['reload'] = TRUE;
			InfoBoxModel::invalidateUserInfoBoxCache(Session::getInstance()->getPlayerId());
		}
	}
} 