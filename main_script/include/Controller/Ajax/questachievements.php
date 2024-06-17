<?php
namespace Controller\Ajax;
use Core\Config;
use Core\Session;
use Core\Locale;
use Model\Quest;
use resources\View\PHPBatchView;

class questachievements extends AjaxBase
{
	public function dispatch()
	{
		if(Quest::getInstance()->isTutorial() && getDisplay("hideDailyQuestWhenOnTutorial")) {
			return;
		}
		if(Session::getInstance()->banned() || Config::getInstance()->dynamic->serverFinished) {
			$this->response['error'] = TRUE;
			$this->response['errorMsg'] = T("inGame", 'bannedSmallPage');
			return;
		}
		$this->response['data']['html'] = PHPBatchView::render('dailyQuest/questachivements');
	}
} 