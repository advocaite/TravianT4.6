<?php

namespace Controller\Ajax\addressbook;

use Controller\Ajax\addressbook;
use Core\Session;
use Core\Helper\WebService;
use Model\MessageModel;
use resources\View\PHPBatchView;

class add extends addressbook
{
	public function dispatch()
    { 
		if (WebService::isPost()) {
			$m = new MessageModel();
            $total = 20 - $m->getTotalFriendListCount(Session::getInstance()->getPlayerId());
            for ($i = 0; $i <= 19; ++$i) {
                if (!empty($_POST['friend'][$i]) && $total) {
					$name = filter_var($_POST['friend'][$i], FILTER_SANITIZE_STRING);
                    $uid = $m->getPlayerIdByName($name);
                    if ($uid !== FALSE && $uid != Session::getInstance()->getPlayerId() && !$m->isPlayerInFriendList($uid)) {
                        $m->addFriendList(Session::getInstance()->getPlayerId(), $uid);
                        $total--;
                    }
                }
            }
            Session::getInstance()->changeChecker();
		
			$this->response = array();
			$view = new PHPBatchView("ajax/addressbook");
			$view->vars['addressBook'] = $this->renderAddressBook();
			$this->response['title'] = T("Messages", "Addressbook");
			$this->response['html'] = $view->output();
        } else if(!WebService::isPost()){
			$this->response['error'] = true;
		}
	}
}