<?php
namespace Controller\Ajax;
use Core\Locale;
use Model\Quest;

class overlay extends AjaxBase
{
	public function dispatch()
	{
		$this->response['data']['texts'] = T("overlay", '.');
		$quest = Quest::getInstance();
		if($quest->getTutorial() == '14-0') {
			$quest->setTutorial('14-1');
		}
	}
}