<?php
namespace Controller\Ajax\player;
use Controller\Ajax\AjaxBase;

use Core\Session;
use Core\Locale;
use Model\MessageModel;
use resources\View\PHPBatchView;

class goldAmount extends AjaxBase
{
    public function dispatch()
    {
		$this->response['goldAmount'] = Session::getInstance()->getAvailableGold();
	}
}