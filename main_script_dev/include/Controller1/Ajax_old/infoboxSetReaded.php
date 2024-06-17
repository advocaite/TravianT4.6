<?php
namespace Controller\Ajax;
use Core\Session;
use Model\InfoBoxModel;
class infoboxSetReaded extends AjaxBase
{
	public function dispatch()
	{
		$infoIds = (array)$_POST['infoIds'];
		if(!sizeof($infoIds)) {
			return;
		}
		foreach($infoIds as $key => &$value) {
			$value = (int)filter_var($value, FILTER_SANITIZE_NUMBER_INT);
			if($value === 0) {
				unset($infoIds[$key]);
			}
		}
		$m = new InfoBoxModel();
		$m->setInfoboxItemsRead(Session::getInstance()->getPlayerId(), $infoIds);
    }
}